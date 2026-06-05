import type { Metadata } from 'next'
import { AcheteurDashboard } from '@/components/dashboard/AcheteurDashboard'

export const metadata: Metadata = {
  title: 'Espace Acheteur — Immo Vision 17',
  description: 'Gérez vos favoris, alertes et visites en Charente-Maritime.',
}

export default function EspaceAcheteurPage() {
  return (
    <div className="min-h-screen pt-20 pb-16 bg-dark-900">
      <div className="container mx-auto px-6">
        <div className="py-8">
          <div className="inline-flex items-center gap-2 glass-gold rounded-full px-4 py-2 mb-4">
            <span className="text-gold-400 text-sm font-medium">Espace Acheteur</span>
          </div>
          <h1 className="font-display text-4xl font-semibold text-white mb-2">
            Mon espace <span className="text-gold-gradient">acheteur</span>
          </h1>
        </div>
        <AcheteurDashboard />
      </div>
    </div>
  )
}
