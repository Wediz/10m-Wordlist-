import type { Metadata } from 'next'
import { EstimationForm } from '@/components/estimation/EstimationForm'
import { CheckCircle2, TrendingUp, Clock, Shield } from 'lucide-react'

export const metadata: Metadata = {
  title: 'Estimation Immobilière Gratuite — Charente-Maritime',
  description:
    'Obtenez une estimation précise et gratuite de votre bien en Charente-Maritime. Réponse personnalisée sous 24h par un expert local.',
  alternates: { canonical: 'https://immovision17.fr/estimation' },
}

const reassurances = [
  { icon: CheckCircle2, title: 'Gratuit & sans engagement', desc: "L'estimation est offerte, sans aucune obligation." },
  { icon: TrendingUp, title: 'Expertise du marché local', desc: 'Connaissance précise des prix en Charente-Maritime.' },
  { icon: Clock, title: 'Réponse sous 24h', desc: 'Votre dossier est étudié rapidement.' },
  { icon: Shield, title: 'Données confidentielles', desc: 'Vos informations ne sont jamais partagées.' },
]

export default function EstimationPage() {
  return (
    <div className="min-h-screen pt-24 pb-20">
      <div className="fixed inset-0 -z-10">
        <div className="absolute inset-0 bg-dark-900" />
        <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] rounded-full bg-gold-500/5 blur-[120px] pointer-events-none" />
      </div>
      <div className="container mx-auto px-6">
        <div className="grid lg:grid-cols-2 gap-16 items-start">
          <div className="lg:sticky lg:top-32">
            <div className="inline-flex items-center gap-2 glass-gold rounded-full px-4 py-2 mb-6">
              <span className="w-1.5 h-1.5 bg-gold-500 rounded-full" />
              <span className="text-gold-400 text-sm font-medium">Estimation gratuite</span>
            </div>
            <h1 className="font-display text-4xl md:text-5xl font-semibold text-white leading-tight mb-6">
              Quelle est la vraie <span className="text-gold-gradient">valeur de votre bien</span>&nbsp;?
            </h1>
            <p className="text-white/55 text-lg leading-relaxed mb-10">
              En 3 minutes, recevez une estimation personnalisée basée sur les ventes récentes dans votre secteur et mon expertise du marché local.
            </p>
            <div className="space-y-4">
              {reassurances.map(({ icon: Icon, title, desc }) => (
                <div key={title} className="flex items-start gap-4">
                  <div className="w-10 h-10 rounded-xl glass-gold flex items-center justify-center flex-shrink-0">
                    <Icon className="w-5 h-5 text-gold-400" />
                  </div>
                  <div>
                    <p className="font-semibold text-white text-sm">{title}</p>
                    <p className="text-white/45 text-sm">{desc}</p>
                  </div>
                </div>
              ))}
            </div>
            <div className="mt-10 glass rounded-2xl p-5">
              <p className="text-white/40 text-xs uppercase tracking-widest mb-1">Partenaire officiel</p>
              <p className="text-white font-semibold text-lg">Efficity</p>
              <p className="text-white/40 text-sm mt-1">Réseau immobilier national — +15 000 mandats</p>
            </div>
          </div>
          <div className="glass rounded-3xl p-8 md:p-10">
            <EstimationForm />
          </div>
        </div>
      </div>
    </div>
  )
}
