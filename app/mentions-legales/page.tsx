import type { Metadata } from 'next'

export const metadata: Metadata = {
  title: 'Mentions Légales — Immo Vision 17',
  robots: { index: false },
}

export default function MentionsLegalesPage() {
  return (
    <div className="min-h-screen pt-24 pb-20 bg-dark-900">
      <div className="container mx-auto px-6 max-w-3xl">
        <h1 className="font-display text-4xl font-semibold text-white mb-10">Mentions Légales</h1>
        <div className="space-y-8 text-white/55 leading-relaxed">
          <section>
            <h2 className="text-white font-semibold text-xl mb-3">Éditeur du site</h2>
            <p>Le site <strong className="text-white">immovision17.fr</strong> est édité par :</p>
            <p className="mt-2">
              Immo Vision 17 — Consultant immobilier indépendant<br />
              Partenaire Efficity SAS, 3 allée de la Robertsau, 75016 Paris<br />
              N° SIREN Efficity : 497 617 235<br />
              Carte professionnelle n° : [votre n° carte pro]<br />
              Garantie financière : [votre banque]<br />
              Assurance RCP : [votre assureur]
            </p>
          </section>
          <section>
            <h2 className="text-white font-semibold text-xl mb-3">Hébergement</h2>
            <p>Ce site est hébergé par Vercel Inc., 340 Pine Street Suite 701, San Francisco, CA 94104, États-Unis.</p>
          </section>
          <section>
            <h2 className="text-white font-semibold text-xl mb-3">Propriété intellectuelle</h2>
            <p>L'ensemble du contenu de ce site est la propriété exclusive d'Immo Vision 17. Toute reproduction sans autorisation écrite est interdite.</p>
          </section>
          <section>
            <h2 className="text-white font-semibold text-xl mb-3">Données personnelles</h2>
            <p>Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Exercez ce droit à : contact@immovision17.fr</p>
          </section>
        </div>
      </div>
    </div>
  )
}
