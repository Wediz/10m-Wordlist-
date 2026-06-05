'use client';

import { motion } from 'framer-motion';
import Link from 'next/link';
import Image from 'next/image';
import { Bed, Bath, Square, MapPin, Eye, ChevronRight } from 'lucide-react';
import { formatPrice } from '@/lib/utils';

const featured = [
  {
    slug: 'villa-prestige-royan-vue-mer',
    title: 'Villa Prestige Vue Mer',
    city: 'Royan',
    price: 1250000,
    surface: 280,
    bedrooms: 4,
    bathrooms: 3,
    image: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800',
    badges: ['Drone 4K', 'Visite 360°'],
    dpe: 'B',
  },
  {
    slug: 'maison-saintongeaise-saintes-centre',
    title: 'Maison Saintongeaise Rénovée',
    city: 'Saintes',
    price: 485000,
    surface: 195,
    bedrooms: 5,
    bathrooms: 2,
    image: 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800',
    badges: ['Photos Pro'],
    dpe: 'C',
  },
  {
    slug: 'appartement-vue-port-rochefort',
    title: 'Appartement Vue Port',
    city: 'Rochefort',
    price: 295000,
    surface: 87,
    bedrooms: 2,
    bathrooms: 1,
    image: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
    badges: ['Visite 360°'],
    dpe: 'D',
  },
];

export default function FeaturedProperties() {
  return (
    <section className="py-24 bg-dark-950">
      <div className="container mx-auto px-4">
        <div className="flex items-end justify-between mb-12">
          <div>
            <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Sélection</span>
            <h2 className="text-4xl font-bold text-white mt-3">
              Biens <span className="text-gradient">d\'exception</span>
            </h2>
          </div>
          <Link href="/biens" className="btn-outline hidden md:flex items-center gap-2">
            Voir tout <ChevronRight className="w-4 h-4" />
          </Link>
        </div>

        <div className="grid md:grid-cols-3 gap-8">
          {featured.map((property, i) => (
            <motion.div
              key={property.slug}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.15 }}
            >
              <Link href={`/biens/${property.slug}`} className="property-card block group">
                <div className="relative overflow-hidden rounded-t-2xl h-60">
                  <Image
                    src={property.image}
                    alt={property.title}
                    fill
                    className="object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <div className="absolute top-3 left-3 flex gap-2">
                    {property.badges.map((badge) => (
                      <span key={badge} className="glass text-white text-xs px-2 py-1 rounded-full border border-gold-800/50">
                        {badge}
                      </span>
                    ))}
                  </div>
                  <div className="absolute top-3 right-3">
                    <span className={`dpe-${property.dpe.toLowerCase()} text-xs font-bold px-2 py-1 rounded`}>
                      DPE {property.dpe}
                    </span>
                  </div>
                </div>
                <div className="glass rounded-b-2xl p-5">
                  <h3 className="text-white font-semibold mb-1 group-hover:text-gold-400 transition-colors">
                    {property.title}
                  </h3>
                  <div className="flex items-center gap-1 text-gray-400 text-sm mb-3">
                    <MapPin className="w-3 h-3" />
                    {property.city}
                  </div>
                  <div className="flex items-center gap-4 text-sm text-gray-400 mb-4">
                    <span className="flex items-center gap-1"><Square className="w-3 h-3" />{property.surface}m²</span>
                    <span className="flex items-center gap-1"><Bed className="w-3 h-3" />{property.bedrooms}</span>
                    <span className="flex items-center gap-1"><Bath className="w-3 h-3" />{property.bathrooms}</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <span className="text-xl font-bold text-gradient">{formatPrice(property.price)}</span>
                    <span className="flex items-center gap-1 text-gold-400 text-sm">
                      <Eye className="w-4 h-4" /> Voir
                    </span>
                  </div>
                </div>
              </Link>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
