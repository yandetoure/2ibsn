<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Level;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function exportStudents(Request $request)
    {
        $query = Student::with(['level']);

        if ($request->has('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->get();

        return Excel::download(new StudentsExport($students), 'eleves_' . date('Y-m-d') . '.xlsx');
    }

    public function importStudentsForm()
    {
        $levels = Level::where('is_active', true)->get();
        return view('admin.import-export.import-students', compact('levels'));
    }

    public function importStudents(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $data = Excel::toArray([], $file);
            
            if (empty($data) || empty($data[0])) {
                return back()->with('error', 'Le fichier est vide.');
            }

            $rows = $data[0];
            $header = array_shift($rows); // Première ligne = en-têtes

            $imported = 0;
            $errors = [];

            DB::beginTransaction();

            foreach ($rows as $index => $row) {
                try {
                    $studentData = $this->mapRowToStudentData($row, $header);
                    
                    $validator = Validator::make($studentData, [
                        'first_name' => 'required|string|max:255',
                        'last_name' => 'required|string|max:255',
                        'gender' => 'required|in:M,F',
                        'birth_date' => 'required|date',
                        'birth_place' => 'required|string|max:255',
                        'nationality' => 'required|string|max:255',
                        'level_id' => 'required|exists:levels,id',
                        'entry_date' => 'required|date',
                    ]);

                    if ($validator->fails()) {
                        $errors[] = "Ligne " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
                        continue;
                    }

                    Student::create($studentData);
                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Ligne " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            DB::commit();

            $message = "$imported élève(s) importé(s) avec succès.";
            if (!empty($errors)) {
                $message .= " " . count($errors) . " erreur(s) rencontrée(s).";
            }

            return back()->with('success', $message)->with('errors', $errors);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de l\'import: ' . $e->getMessage());
        }
    }

    private function mapRowToStudentData(array $row, array $header): array
    {
        $mapped = [];
        $headerMap = [
            'prenom' => 'first_name',
            'nom' => 'last_name',
            'sexe' => 'gender',
            'date_naissance' => 'birth_date',
            'lieu_naissance' => 'birth_place',
            'nationalite' => 'nationality',
            'langue' => 'spoken_language',
            'niveau' => 'level_id',
            'date_entree' => 'entry_date',
            'nom_pere' => 'father_name',
            'tel_pere' => 'father_phone',
            'nom_mere' => 'mother_name',
            'tel_mere' => 'mother_phone',
            'adresse' => 'parents_address',
            'villa' => 'villa_number',
            'responsable' => 'responsible_name',
            'tel_responsable' => 'responsible_phone',
        ];

        foreach ($header as $index => $col) {
            $col = strtolower(trim($col));
            if (isset($headerMap[$col]) && isset($row[$index])) {
                $key = $headerMap[$col];
                $value = trim($row[$index] ?? '');
                
                if ($key == 'level_id' && !is_numeric($value)) {
                    $level = Level::where('name', 'like', "%{$value}%")->orWhere('code', $value)->first();
                    $value = $level ? $level->id : null;
                }
                
                $mapped[$key] = $value;
            }
        }

        $mapped['status'] = 'active';
        return $mapped;
    }
}

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Prénom',
            'Nom',
            'Sexe',
            'Date de naissance',
            'Lieu de naissance',
            'Nationalité',
            'Langue parlée',
            'Niveau',
            'Date d\'entrée',
            'Statut',
            'Nom Père',
            'Téléphone Père',
            'Nom Mère',
            'Téléphone Mère',
            'Adresse',
            'Villa N°',
            'Responsable',
            'Téléphone Responsable',
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->first_name,
            $student->last_name,
            $student->gender == 'M' ? 'Masculin' : 'Féminin',
            $student->birth_date->format('d/m/Y'),
            $student->birth_place,
            $student->nationality,
            $student->spoken_language,
            $student->level->name ?? 'N/A',
            $student->entry_date->format('d/m/Y'),
            ucfirst($student->status),
            $student->father_name ?? '',
            $student->father_phone ?? '',
            $student->mother_name ?? '',
            $student->mother_phone ?? '',
            $student->parents_address ?? '',
            $student->villa_number ?? '',
            $student->responsible_name ?? '',
            $student->responsible_phone ?? '',
        ];
    }
}
