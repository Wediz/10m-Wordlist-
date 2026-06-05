'use client';

import { motion } from 'framer-motion';
import { Check } from 'lucide-react';
import { PREMIUM_SERVICES } from '@/lib/constants';
import Link from 'next/link';

export default function PromiseSection() {
  return (
    <section className="py-24 bg-dark-900">
      <div className="container mx-auto px-4">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <div>
            <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Notre promesse</span>
            <h2 className="text-4xl font-bold text-white mt-3 mb-6">
              Tout inclus,
              <span className="text-gradient"> zéro surprise</span>
            </h2>
            <p className="text-gray-400 mb-8">
              Avec Immo Vision 17, vous bénéficiez d\'un service complet dès la signature du mandat.
              Aucun frais caché, aucune mauvaise surprise.
            </p>
            <ul className="space-y-3 mb-8">
              {PREMIUM_SERVICES.map((service, i) => (
                <motion.li
                  key={i}
                  initial={{ opacity: 0, x: -20 }}
                  whileInView={{ opacity: 1, x: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: i * 0.1 }}
                  className="flex items-center gap-3"
                >
                  <div className="w-5 h-5 rounded-full bg-gold-900/50 flex items-center justify-center flex-shrink-0">
                    <Check className="w-3 h-3 text-gold-400" />
                  </div>
                  <span className="text-gray-300">{service}</span>
                </motion.li>
              ))}
            </ul>
            <Link href="/contact" className="btn-gold">
              Prendre rendez-vous
            </Link>
          </div>

          <div className="relative">
            <div className="glass-gold rounded-3xl p-8">
              <div className="text-center mb-6">
                <div className="text-5xl font-bold text-gradient mb-2">3.5%</div>
                <div className="text-white font-semibold">Honoraires tout inclus</div>
                <div className="text-gray-400 text-sm mt-1">TVA incluse • Aucun frais caché</div>
              </div>
              <div className="space-y-2">
                {PREMIUM_SERVICES.map((s, i) => (
                  <div key={i} className="flex items-center gap-2 text-sm text-gray-300">
                    <Check className="w-4 h-4 text-gold-400 flex-shrink-0" />
                    {s}
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
