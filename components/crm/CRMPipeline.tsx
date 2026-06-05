'use client';

import { useState } from 'react';
import { CRM_STAGES } from '@/lib/constants';
import { formatPrice } from '@/lib/utils';
import { Plus, Phone, Mail, MapPin } from 'lucide-react';

interface Deal {
  id: string;
  title: string;
  client: string;
  value: number;
  stage: string;
  priority: 'low' | 'medium' | 'high';
  nextAction?: string;
}

const initialDeals: Deal[] = [
  { id: '1', title: 'Villa Royan', client: 'M. Martin', value: 850000, stage: 'visite', priority: 'high', nextAction: 'Contre-visite jeudi' },
  { id: '2', title: 'Appart Saintes', client: 'Mme Bernard', value: 195000, stage: 'negociation', priority: 'medium', nextAction: 'Offre à transmettre' },
  { id: '3', title: 'Maison Rochefort', client: 'M. & Mme Petit', value: 320000, stage: 'compromis', priority: 'high', nextAction: 'Signature notaire 15/07' },
  { id: '4', title: 'Terrain Cognac', client: 'M. Dubois', value: 85000, stage: 'prospect', priority: 'low' },
  { id: '5', title: 'Château Jonzac', client: 'Famille Leclerc', value: 1200000, stage: 'contact', priority: 'high', nextAction: 'RDV estimation lundi' },
  { id: '6', title: 'Studio Saintes', client: 'Mme Garcia', value: 95000, stage: 'financement', priority: 'medium', nextAction: 'Attente accord bancaire' },
  { id: '7', title: 'Maison Pons', client: 'M. Thomas', value: 245000, stage: 'acte', priority: 'high', nextAction: 'Acte authentique 20/07' },
];

const priorityColors = { low: 'bg-gray-500', medium: 'bg-yellow-500', high: 'bg-red-500' };

export default function CRMPipeline() {
  const [deals, setDeals] = useState(initialDeals);
  const [dragging, setDragging] = useState<string | null>(null);

  const handleDragStart = (id: string) => setDragging(id);
  const handleDragOver = (e: React.DragEvent) => e.preventDefault();
  const handleDrop = (stage: string) => {
    if (!dragging) return;
    setDeals((prev) => prev.map((d) => d.id === dragging ? { ...d, stage } : d));
    setDragging(null);
  };

  return (
    <div className="overflow-x-auto">
      <div className="flex gap-4 min-w-max pb-4">
        {CRM_STAGES.map((stage) => {
          const stageDeals = deals.filter((d) => d.stage === stage.id);
          const total = stageDeals.reduce((sum, d) => sum + d.value, 0);
          return (
            <div
              key={stage.id}
              className="w-72 flex-shrink-0"
              onDragOver={handleDragOver}
              onDrop={() => handleDrop(stage.id)}
            >
              <div className="flex items-center justify-between mb-3">
                <div className="flex items-center gap-2">
                  <div className="w-2 h-2 rounded-full" style={{ backgroundColor: stage.color }} />
                  <span className="text-white text-sm font-medium">{stage.label}</span>
                  <span className="text-gray-500 text-xs">({stageDeals.length})</span>
                </div>
                <span className="text-gold-400 text-xs">{formatPrice(total)}</span>
              </div>

              <div className="space-y-3 min-h-[200px]">
                {stageDeals.map((deal) => (
                  <div
                    key={deal.id}
                    draggable
                    onDragStart={() => handleDragStart(deal.id)}
                    className="glass rounded-xl p-4 cursor-grab active:cursor-grabbing hover:border-gold-800/50 border border-transparent transition-all"
                  >
                    <div className="flex items-start justify-between mb-2">
                      <h4 className="text-white text-sm font-medium">{deal.title}</h4>
                      <div className={`w-2 h-2 rounded-full ${priorityColors[deal.priority]} flex-shrink-0 mt-1`} />
                    </div>
                    <p className="text-gray-400 text-xs mb-2">{deal.client}</p>
                    <p className="text-gold-400 text-sm font-semibold mb-3">{formatPrice(deal.value)}</p>
                    {deal.nextAction && (
                      <p className="text-gray-500 text-xs border-t border-white/5 pt-2">
                        → {deal.nextAction}
                      </p>
                    )}
                    <div className="flex gap-2 mt-3">
                      <button className="w-7 h-7 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-gold-400">
                        <Phone className="w-3 h-3" />
                      </button>
                      <button className="w-7 h-7 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-gold-400">
                        <Mail className="w-3 h-3" />
                      </button>
                      <button className="w-7 h-7 rounded-lg glass flex items-center justify-center text-gray-400 hover:text-gold-400">
                        <MapPin className="w-3 h-3" />
                      </button>
                    </div>
                  </div>
                ))}

                <button className="w-full flex items-center justify-center gap-2 py-3 text-gray-600 hover:text-gray-400 text-sm border border-dashed border-white/10 rounded-xl hover:border-white/20 transition-all">
                  <Plus className="w-4 h-4" />
                  Ajouter
                </button>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
}
