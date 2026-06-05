'use client';

import { useState } from 'react';
import { motion } from 'framer-motion';
import { Bed, Bath, Square, MapPin, Calendar, Check, Phone, Mail, Calculator } from 'lucide-react';
import PropertyGallery from './PropertyGallery';
import MortgageCalculator from './MortgageCalculator';
import { formatPrice, getDPEColor } from '@/lib/utils';

const mockProperty = {
  title: 'Villa Prestige avec Vue Mer Panoramique',
  city: 'Royan',
  postalCode: '17200',
  price: 1250000,
  surface: 280,
  landSurface: 1200,
  rooms: 7,
  bedrooms: 4,
  bathrooms: 3,
  yearBuilt: 2019,
  dpeScore: 'B',
  gesScore: 'A',
  hasPool: true,
  hasGarage: true,
  hasGarden: true,
  hasSeaView: true,
  hasTerrace: true,
  description: 'Exceptional villa located in Royan, offering a breathtaking panoramic view of the Atlantic Ocean. This prestigious property combines contemporary architecture with premium finishes. The generous volumes and premium materials create an exceptional living environment. Swimming pool, landscaped garden, 4 bedrooms, home cinema, wine cellar.',
  images: [
    { url: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=1200', alt: 'Facade' },
    { url: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200', alt: 'Living room' },
    { url: 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200', alt: 'Kitchen' },
    { url: 'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?w=1200', alt: 'Bedroom' },
    { url: 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1200', alt: 'Pool' },
  ],
};

export default function PropertyDetail() {
  const [tab, setTab] = useState<'desc' | 'plan' | 'calc'>('desc');
  const [showCalc, setShowCalc] = useState(false);

  const p = mockProperty;
  const features = [
    { label: 'Surface', value: `${p.surface} m²` },
    { label: 'Terrain', value: p.landSurface ? `${p.landSurface} m²` : '-' },
    { label: 'Pièces', value: p.rooms },
    { label: 'Chambres', value: p.bedrooms },
    { label: 'SDB', value: p.bathrooms },
    { label: 'Construction', value: p.yearBuilt || '-' },
  ];
  const amenities = [
    { label: 'Piscine', value: p.hasPool },
    { label: 'Garage', value: p.hasGarage },
    { label: 'Jardin', value: p.hasGarden },
    { label: 'Vue mer', value: p.hasSeaView },
    { label: 'Terrasse', value: p.hasTerrace },
  ];

  return (
    <div className="space-y-8">
      <PropertyGallery images={p.images} title={p.title} />

      <div className="grid lg:grid-cols-3 gap-8">
        {/* Main content */}
        <div className="lg:col-span-2 space-y-8">
          <div>
            <div className="flex items-start justify-between mb-4">
              <div>
                <h1 className="text-3xl font-bold text-white mb-2">{p.title}</h1>
                <div className="flex items-center gap-2 text-gray-400">
                  <MapPin className="w-4 h-4" />
                  <span>{p.city}, {p.postalCode}</span>
                </div>
              </div>
              <div className="text-right">
                <div className="text-3xl font-bold text-gradient">{formatPrice(p.price)}</div>
                <div className="text-gray-400 text-sm">{Math.round(p.price / p.surface).toLocaleString('fr-FR')} €/m²</div>
              </div>
            </div>

            <div className="grid grid-cols-3 sm:grid-cols-6 gap-4">
              {features.map((f) => (
                <div key={f.label} className="glass rounded-xl p-3 text-center">
                  <div className="text-white font-semibold">{f.value}</div>
                  <div className="text-gray-400 text-xs">{f.label}</div>
                </div>
              ))}
            </div>
          </div>

          {/* Tabs */}
          <div>
            <div className="flex gap-4 border-b border-white/10 mb-6">
              {[{ id: 'desc', label: 'Description' }, { id: 'plan', label: 'Plan' }, { id: 'calc', label: 'Simulateur' }].map((t) => (
                <button
                  key={t.id}
                  onClick={() => setTab(t.id as typeof tab)}
                  className={`pb-3 text-sm font-medium transition-colors border-b-2 -mb-px ${
                    tab === t.id
                      ? 'text-gold-400 border-gold-400'
                      : 'text-gray-400 border-transparent hover:text-white'
                  }`}
                >
                  {t.label}
                </button>
              ))}
            </div>
            {tab === 'desc' && (
              <div>
                <p className="text-gray-300 leading-relaxed mb-6">{p.description}</p>
                <div className="grid grid-cols-2 sm:grid-cols-3 gap-3">
                  {amenities.map((a) => (
                    <div
                      key={a.label}
                      className={`flex items-center gap-2 text-sm ${
                        a.value ? 'text-gray-300' : 'text-gray-600'
                      }`}
                    >
                      <Check className={`w-4 h-4 ${a.value ? 'text-gold-400' : 'text-gray-700'}`} />
                      {a.label}
                    </div>
                  ))}
                </div>
              </div>
            )}
            {tab === 'calc' && (
              <MortgageCalculator propertyPrice={p.price} />
            )}
          </div>

          {/* DPE */}
          <div className="glass rounded-2xl p-6">
            <h3 className="text-white font-semibold mb-4">Diagnostics énergétiques</h3>
            <div className="flex gap-6">
              <div className="text-center">
                <div
                  className="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white mb-2"
                  style={{ backgroundColor: getDPEColor(p.dpeScore) }}
                >
                  {p.dpeScore}
                </div>
                <div className="text-gray-400 text-xs">DPE</div>
              </div>
              <div className="text-center">
                <div
                  className="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold text-white mb-2"
                  style={{ backgroundColor: getDPEColor(p.gesScore) }}
                >
                  {p.gesScore}
                </div>
                <div className="text-gray-400 text-xs">GES</div>
              </div>
            </div>
          </div>
        </div>

        {/* Sidebar */}
        <div className="space-y-6">
          <div className="glass-gold rounded-2xl p-6">
            <h3 className="text-white font-semibold mb-4">Votre conseiller</h3>
            <div className="flex items-center gap-3 mb-4">
              <div className="w-12 h-12 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-dark-950 font-bold">
                IV
              </div>
              <div>
                <div className="text-white font-medium">Immo Vision 17</div>
                <div className="text-gold-400 text-sm">Conseiller immobilier</div>
              </div>
            </div>
            <div className="space-y-3">
              <a
                href={`tel:${process.env.NEXT_PUBLIC_AGENT_PHONE || '0612345678'}`}
                className="btn-gold w-full flex items-center justify-center gap-2"
              >
                <Phone className="w-4 h-4" /> Appeler
              </a>
              <a
                href="/contact"
                className="btn-outline w-full flex items-center justify-center gap-2"
              >
                <Mail className="w-4 h-4" /> Message
              </a>
            </div>
          </div>

          <div className="glass rounded-2xl p-6">
            <div className="flex items-center gap-2 text-gray-400 text-sm mb-2">
              <Calendar className="w-4 h-4" />
              Planifier une visite
            </div>
            <p className="text-gray-300 text-sm">Disponible 7j/7 pour vous accompagner.</p>
            <a href="/contact" className="btn-gold w-full mt-4 block text-center">
              Demander une visite
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
