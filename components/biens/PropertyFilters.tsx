'use client';

import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { SlidersHorizontal, X } from 'lucide-react';
import { SEO_CITIES, PROPERTY_TYPES } from '@/lib/constants';
import type { PropertyFilters } from '@/lib/types';

interface PropertyFiltersProps {
  filters: PropertyFilters;
  onChange: (filters: PropertyFilters) => void;
}

export default function PropertyFiltersComponent({ filters, onChange }: PropertyFiltersProps) {
  const [mobileOpen, setMobileOpen] = useState(false);

  const update = (key: keyof PropertyFilters, value: unknown) => {
    onChange({ ...filters, [key]: value || undefined });
  };

  const reset = () => onChange({});

  const FilterContent = () => (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h3 className="text-white font-semibold">Filtres</h3>
        <button onClick={reset} className="text-gold-400 text-sm hover:text-gold-300 transition-colors">
          Réinitialiser
        </button>
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Type de bien</label>
        <select
          value={filters.type || ''}
          onChange={(e) => update('type', e.target.value)}
          className="input-premium w-full"
        >
          <option value="">Tous types</option>
          {PROPERTY_TYPES.map((t) => (
            <option key={t.value} value={t.value}>{t.label}</option>
          ))}
        </select>
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Ville</label>
        <select
          value={filters.city || ''}
          onChange={(e) => update('city', e.target.value)}
          className="input-premium w-full"
        >
          <option value="">Toutes villes</option>
          {SEO_CITIES.map((c) => (
            <option key={c.slug} value={c.name}>{c.name}</option>
          ))}
        </select>
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Prix maximum</label>
        <select
          value={filters.maxPrice || ''}
          onChange={(e) => update('maxPrice', Number(e.target.value))}
          className="input-premium w-full"
        >
          <option value="">Sans limite</option>
          <option value="200000">200 000 €</option>
          <option value="300000">300 000 €</option>
          <option value="500000">500 000 €</option>
          <option value="750000">750 000 €</option>
          <option value="1000000">1 000 000 €</option>
        </select>
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Surface minimum</label>
        <select
          value={filters.minSurface || ''}
          onChange={(e) => update('minSurface', Number(e.target.value))}
          className="input-premium w-full"
        >
          <option value="">Toutes surfaces</option>
          <option value="30">30 m²</option>
          <option value="50">50 m²</option>
          <option value="80">80 m²</option>
          <option value="100">100 m²</option>
          <option value="150">150 m²</option>
          <option value="200">200 m²</option>
        </select>
      </div>

      <div className="space-y-3">
        <label className="text-gray-400 text-sm block">Options</label>
        {[
          { key: 'hasPool', label: 'Piscine' },
          { key: 'hasSeaView', label: 'Vue mer' },
        ].map(({ key, label }) => (
          <label key={key} className="flex items-center gap-3 cursor-pointer group">
            <input
              type="checkbox"
              checked={!!filters[key as keyof PropertyFilters]}
              onChange={(e) => update(key as keyof PropertyFilters, e.target.checked || undefined)}
              className="w-4 h-4 accent-gold-400"
            />
            <span className="text-gray-300 group-hover:text-white transition-colors text-sm">{label}</span>
          </label>
        ))}
      </div>
    </div>
  );

  return (
    <>
      {/* Desktop */}
      <div className="hidden lg:block glass rounded-2xl p-6 sticky top-24">
        <FilterContent />
      </div>

      {/* Mobile toggle */}
      <button
        className="lg:hidden btn-outline flex items-center gap-2 mb-6"
        onClick={() => setMobileOpen(true)}
      >
        <SlidersHorizontal className="w-4 h-4" />
        Filtres
      </button>

      <AnimatePresence>
        {mobileOpen && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 bg-black/80 lg:hidden"
            onClick={() => setMobileOpen(false)}
          >
            <motion.div
              initial={{ x: '-100%' }}
              animate={{ x: 0 }}
              exit={{ x: '-100%' }}
              className="absolute left-0 top-0 bottom-0 w-80 bg-dark-900 p-6 overflow-y-auto"
              onClick={(e) => e.stopPropagation()}
            >
              <div className="flex items-center justify-between mb-6">
                <span className="text-white font-bold">Filtres</span>
                <button onClick={() => setMobileOpen(false)}><X className="w-6 h-6 text-white" /></button>
              </div>
              <FilterContent />
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
