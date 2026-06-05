import type { Metadata } from 'next'
import { CRMPipeline } from '@/components/crm/CRMPipeline'
import { CRMStats } from '@/components/crm/CRMStats'

export const metadata: Metadata = {
  title: 'CRM — Immo Vision 17',
  robots: { index: false, follow: false },
}

export default function CRMPage() {
  return (
    <div className="min-h-screen pt-20 pb-16 bg-dark-900">
      <div className="px-6 py-6">
        <div className="flex items-center justify-between mb-8">
          <div>
            <h1 className="font-display text-3xl font-semibold text-white">CRM</h1>
            <p className="text-white/40 text-sm mt-1">Pipeline de vente en temps réel</p>
          </div>
          <button className="btn-gold px-5 py-2.5 rounded-xl text-sm font-semibold">+ Nouveau dossier</button>
        </div>
        <CRMStats />
        <div className="mt-8"><CRMPipeline /></div>
      </div>
    </div>
  )
}
