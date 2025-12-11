@extends('layouts.app')

@section('title', 'Contact - 2IBSN')

@section('content')
    <div class="page-header" style="background-color: var(--primary); color: white; padding: 4rem 0; text-align: center;">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p>Nous sommes à votre écoute pour toute information</p>
        </div>
    </div>

    <section class="section" style="padding: 5rem 0;">
        <div class="container">
            <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">

                <div class="contact-info">
                    <h3>Nos Coordonnées</h3>
                    <div class="contact-item" style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: center;">
                        <div
                            style="background: var(--secondary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            📍</div>
                        <div>
                            <strong>Adresse</strong>
                            <p style="margin: 0;">Institut International Baye Barhamou (2ib)</p>
                        </div>
                    </div>

                    <div class="contact-item" style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: center;">
                        <div
                            style="background: var(--secondary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            📞</div>
                        <div>
                            <strong>Téléphone / WhatsApp</strong>
                            <p style="margin: 0;"><a href="https://wa.me/221773750724" target="_blank">+221 77 375 07 24</a>
                            </p>
                            <p style="margin: 0;">+221 77 486 27 27</p>
                        </div>
                    </div>

                    <div class="contact-item" style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: center;">
                        <div
                            style="background: var(--secondary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            ✉️</div>
                        <div>
                            <strong>Email</strong>
                            <p style="margin: 0;"><a
                                    href="mailto:institutinternationalbayebarha@gmail.com">institutinternationalbayebarha@gmail.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item" style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: center;">
                        <div
                            style="background: var(--secondary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            👤</div>
                        <div>
                            <strong>Directeur</strong>
                            <p style="margin: 0;">Madiara Ndiaye</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container"
                    style="background: white; padding: 2rem; border-radius: 12px; box-shadow: var(--shadow-card);">
                    <h3>Envoyer un Message</h3>
                    <form action="#" method="POST"
                        onsubmit="event.preventDefault(); alert('Ce formulaire est une démonstration.');">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom Complet</label>
                            <input type="text" id="name" class="form-control" placeholder="Votre nom">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="votre@email.com">
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" class="form-control" rows="5"
                                placeholder="Comment pouvons-nous vous aider ?"></textarea>
                        </div>
                        <button type="submit" class="btn"
                            style="width: 100%; border: none; cursor: pointer;">Envoyer</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection