import type { Metadata } from 'next'
import { PropertyFilters } from '@/components/biens/PropertyFilters'
import { PropertyGrid } from '@/components/biens/PropertyGrid'

export const metadata: Metadata = {
  title: 'Biens Immobiliers à Vendre — Charente-Maritime',
  description:
    'Découvrez notre sélection exclusive de maisons, appartements et villas en Charente-Maritime. Photos pro, drone et visite virtuelle 360° pour chaque bien.',
  alternates: { canonical: 'https://immovision17.fr/biens' },
}

export default function BiensPage() {
  return (
    <div className="min-h-screen pt-24 pb-20">
      <div className="fixed inset-0 -z-10 bg-dark-900" />
      <div className="container mx-auto px-6">
        <div className="mb-10">
          <div className="inline-flex items-center gap-2 glass-gold rounded-full px-4 py-2 mb-4">
            <span className="text-gold-400 text-sm font-medium uppercase tracking-widest">Catalogue</span>
          </div>
          <h1 className="font-display text-4xl md:text-5xl font-semibold text-white">
            Biens en <span className="text-gold-gradient">Charente-Maritime</span>
          </h1>
          <p className="text-white/45 mt-3 text-lg">
            Chaque bien bénéficie de photos pro, drone, visite 360° et vidéo cinématique.
          </p>
        </div>
        <div className="flex flex-col lg:flex-row gap-8">
          <aside className="lg:w-72 flex-shrink-0">
            <PropertyFilters />
          </aside>
          <div className="flex-1">
            <PropertyGrid />
          </div>
        </div>
      </div>
    </div>
  )
}
