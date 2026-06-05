'use client';

import { useState } from 'react';
import Image from 'next/image';
import Link from 'next/link';
import { Heart, Bell, Clock, FileText, MapPin, Bed, Square, Trash2 } from 'lucide-react';
import { formatPrice } from '@/lib/utils';

const mockFavorites = [
  {
    slug: 'villa-prestige-royan-vue-mer',
    title: 'Villa Prestige Vue Mer',
    city: 'Royan',
    price: 1250000,
    surface: 280,
    bedrooms: 4,
    image: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=400',
  },
  {
    slug: 'maison-saintongeaise-saintes-centre',
    title: 'Maison Saintongeaise Rénovée',
    city: 'Saintes',
    price: 485000,
    surface: 195,
    bedrooms: 5,
    image: 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=400',
  },
];

const mockAlerts = [
  { name: 'Maisons Royan > 150m²', count: 3, lastUpdate: 'il y a 2h' },
  { name: 'Appartements Saintes < 300k', count: 7, lastUpdate: 'il y a 1j' },
];

const tabs = [
  { id: 'favoris', label: 'Favoris', icon: Heart },
  { id: 'alertes', label: 'Alertes', icon: Bell },
  { id: 'historique', label: 'Historique', icon: Clock },
  { id: 'documents', label: 'Documents', icon: FileText },
];

export default function AcheteurDashboard() {
  const [activeTab, setActiveTab] = useState('favoris');

  return (
    <div className="space-y-6">
      <div className="flex gap-2 border-b border-white/10">
        {tabs.map((tab) => (
          <button
            key={tab.id}
            onClick={() => setActiveTab(tab.id)}
            className={`flex items-center gap-2 px-4 py-3 text-sm font-medium transition-colors border-b-2 -mb-px ${
              activeTab === tab.id
                ? 'text-gold-400 border-gold-400'
                : 'text-gray-400 border-transparent hover:text-white'
            }`}
          >
            <tab.icon className="w-4 h-4" />
            {tab.label}
          </button>
        ))}
      </div>

      {activeTab === 'favoris' && (
        <div className="grid sm:grid-cols-2 gap-6">
          {mockFavorites.map((p) => (
            <div key={p.slug} className="glass rounded-2xl overflow-hidden group">
              <div className="relative h-44">
                <Image src={p.image} alt={p.title} fill className="object-cover group-hover:scale-105 transition-transform duration-500" />
                <button className="absolute top-3 right-3 w-8 h-8 glass rounded-full flex items-center justify-center text-red-400 hover:bg-red-900/30">
                  <Trash2 className="w-4 h-4" />
                </button>
              </div>
              <div className="p-4">
                <h3 className="text-white font-semibold mb-1">{p.title}</h3>
                <div className="flex items-center gap-1 text-gray-400 text-sm mb-2">
                  <MapPin className="w-3 h-3" /> {p.city}
                </div>
                <div className="flex items-center gap-4 text-sm text-gray-400 mb-3">
                  <span className="flex items-center gap-1"><Square className="w-3 h-3" />{p.surface}m²</span>
                  <span className="flex items-center gap-1"><Bed className="w-3 h-3" />{p.bedrooms} ch.</span>
                </div>
                <div className="flex items-center justify-between">
                  <span className="text-gold-400 font-bold">{formatPrice(p.price)}</span>
                  <Link href={`/biens/${p.slug}`} className="text-sm text-gray-400 hover:text-gold-400">
                    Voir le bien →
                  </Link>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}

      {activeTab === 'alertes' && (
        <div className="space-y-4">
          {mockAlerts.map((alert, i) => (
            <div key={i} className="glass rounded-xl p-5 flex items-center justify-between">
              <div>
                <h4 className="text-white font-medium">{alert.name}</h4>
                <p className="text-gray-400 text-sm mt-1">{alert.count} nouveaux résultats • {alert.lastUpdate}</p>
              </div>
              <div className="flex items-center gap-3">
                <Bell className="w-5 h-5 text-gold-400" />
                <button className="text-gray-500 hover:text-red-400 text-sm transition-colors">Supprimer</button>
              </div>
            </div>
          ))}
          <button className="btn-outline w-full">Créer une alerte</button>
        </div>
      )}

      {activeTab === 'historique' && (
        <div className="text-center py-12">
          <Clock className="w-12 h-12 text-gray-600 mx-auto mb-3" />
          <p className="text-gray-400">Historique de vos visites et recherches</p>
        </div>
      )}

      {activeTab === 'documents' && (
        <div className="text-center py-12">
          <FileText className="w-12 h-12 text-gray-600 mx-auto mb-3" />
          <p className="text-gray-400">Vos documents et compromis</p>
        </div>
      )}
    </div>
  );
}
