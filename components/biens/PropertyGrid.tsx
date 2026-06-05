'use client';

import { useState } from 'react';
import Image from 'next/image';
import Link from 'next/link';
import { motion } from 'framer-motion';
import { Bed, Bath, Square, MapPin, Heart, LayoutGrid, List } from 'lucide-react';
import { formatPrice } from '@/lib/utils';
import { getDPEColor } from '@/lib/utils';

const mockProperties = [
  {
    slug: 'villa-prestige-royan-vue-mer',
    title: 'Villa Prestige Vue Mer',
    city: 'Royan', price: 1250000, surface: 280,
    bedrooms: 4, bathrooms: 3, rooms: 7,
    image: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=600',
    dpe: 'B', hasPool: true, hasSeaView: true, type: 'maison',
  },
  {
    slug: 'maison-saintongeaise-saintes-centre',
    title: 'Maison Saintongeaise Rénovée',
    city: 'Saintes', price: 485000, surface: 195,
    bedrooms: 5, bathrooms: 2, rooms: 8,
    image: 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=600',
    dpe: 'C', hasPool: false, hasSeaView: false, type: 'maison',
  },
  {
    slug: 'appartement-vue-port-rochefort',
    title: 'Appartement Vue Port',
    city: 'Rochefort', price: 295000, surface: 87,
    bedrooms: 2, bathrooms: 1, rooms: 4,
    image: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600',
    dpe: 'D', hasPool: false, hasSeaView: true, type: 'appartement',
  },
  {
    slug: 'chateau-saintonge-jonzac',
    title: 'Château Saintonge',
    city: 'Jonzac', price: 890000, surface: 450,
    bedrooms: 8, bathrooms: 4, rooms: 15,
    image: 'https://images.unsplash.com/photo-1533154683836-84ea7a0bc310?w=600',
    dpe: 'E', hasPool: true, hasSeaView: false, type: 'chateau',
  },
  {
    slug: 'maison-contemporaine-cognac',
    title: 'Maison Contemporaine',
    city: 'Cognac', price: 325000, surface: 138,
    bedrooms: 3, bathrooms: 2, rooms: 6,
    image: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600',
    dpe: 'A', hasPool: false, hasSeaView: false, type: 'maison',
  },
  {
    slug: 'terrain-constructible-pons',
    title: 'Terrain Constructible',
    city: 'Pons', price: 85000, surface: 850,
    bedrooms: 0, bathrooms: 0, rooms: 0,
    image: 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600',
    dpe: '', hasPool: false, hasSeaView: false, type: 'terrain',
  },
];

export default function PropertyGrid() {
  const [view, setView] = useState<'grid' | 'list'>('grid');
  const [favorites, setFavorites] = useState<string[]>([]);

  const toggleFav = (slug: string) => {
    setFavorites((prev) => prev.includes(slug) ? prev.filter((s) => s !== slug) : [...prev, slug]);
  };

  return (
    <div>
      <div className="flex items-center justify-between mb-6">
        <p className="text-gray-400 text-sm">{mockProperties.length} biens trouvés</p>
        <div className="flex items-center gap-2">
          <button
            onClick={() => setView('grid')}
            className={`p-2 rounded-lg transition-colors ${
              view === 'grid' ? 'bg-gold-900/50 text-gold-400' : 'text-gray-500 hover:text-white'
            }`}
          >
            <LayoutGrid className="w-4 h-4" />
          </button>
          <button
            onClick={() => setView('list')}
            className={`p-2 rounded-lg transition-colors ${
              view === 'list' ? 'bg-gold-900/50 text-gold-400' : 'text-gray-500 hover:text-white'
            }`}
          >
            <List className="w-4 h-4" />
          </button>
        </div>
      </div>

      <div className={view === 'grid' ? 'grid sm:grid-cols-2 xl:grid-cols-3 gap-6' : 'space-y-4'}>
        {mockProperties.map((p, i) => (
          <motion.div
            key={p.slug}
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: i * 0.08 }}
            className="relative"
          >
            <button
              onClick={() => toggleFav(p.slug)}
              className={`absolute top-3 right-3 z-10 w-8 h-8 rounded-full glass flex items-center justify-center transition-colors ${
                favorites.includes(p.slug) ? 'text-red-400' : 'text-gray-400 hover:text-red-400'
              }`}
            >
              <Heart className={`w-4 h-4 ${favorites.includes(p.slug) ? 'fill-current' : ''}`} />
            </button>

            <Link href={`/biens/${p.slug}`} className="property-card block group">
              <div className={`relative overflow-hidden ${
                view === 'grid' ? 'rounded-t-2xl h-52' : 'rounded-l-2xl h-40 w-60 flex-shrink-0'
              }`}>
                <Image
                  src={p.image}
                  alt={p.title}
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-500"
                />
                {p.dpe && (
                  <div
                    className="absolute bottom-3 left-3 text-xs font-bold px-2 py-1 rounded text-white"
                    style={{ backgroundColor: getDPEColor(p.dpe) }}
                  >
                    DPE {p.dpe}
                  </div>
                )}
              </div>
              <div className="glass rounded-b-2xl p-5">
                <h3 className="text-white font-semibold mb-1 group-hover:text-gold-400 transition-colors">
                  {p.title}
                </h3>
                <div className="flex items-center gap-1 text-gray-400 text-sm mb-3">
                  <MapPin className="w-3 h-3" /> {p.city}
                </div>
                <div className="flex items-center gap-4 text-sm text-gray-400 mb-4">
                  <span className="flex items-center gap-1"><Square className="w-3 h-3" />{p.surface}m²</span>
                  {p.bedrooms > 0 && <span className="flex items-center gap-1"><Bed className="w-3 h-3" />{p.bedrooms}</span>}
                  {p.bathrooms > 0 && <span className="flex items-center gap-1"><Bath className="w-3 h-3" />{p.bathrooms}</span>}
                </div>
                <div className="text-xl font-bold text-gradient">{formatPrice(p.price)}</div>
              </div>
            </Link>
          </motion.div>
        ))}
      </div>
    </div>
  );
}
