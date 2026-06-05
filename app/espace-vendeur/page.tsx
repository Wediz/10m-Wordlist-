import type { Metadata } from 'next'
import { VendeurDashboard } from '@/components/dashboard/VendeurDashboard'

export const metadata: Metadata = {
  title: 'Espace Vendeur — Immo Vision 17',
  description: 'Suivez en temps réel les performances de votre bien : vues, contacts, visites planifiées.',
}

export default function EspaceVendeurPage() {
  return (
    <div className="min-h-screen pt-20 pb-16 bg-dark-900">
      <div className="container mx-auto px-6">
        <div className="py-8">
          <div className="inline-flex items-center gap-2 glass-gold rounded-full px-4 py-2 mb-4">
            <span className="text-gold-400 text-sm font-medium">Espace Vendeur</span>
          </div>
          <h1 className="font-display text-4xl font-semibold text-white mb-2">
            Tableau de bord <span className="text-gold-gradient">vendeur</span>
          </h1>
          <p className="text-white/40">Suivez les performances de votre bien en temps réel.</p>
        </div>
        <VendeurDashboard />
      </div>
    </div>
  )
}
