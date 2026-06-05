'use client';

import { useInView } from 'framer-motion';
import { useRef } from 'react';
import CountUp from 'react-countup';

const stats = [
  { value: 250, suffix: '+', label: 'Biens vendus', description: 'en Charente-Maritime' },
  { value: 98, suffix: '%', label: 'Clients satisfaits', description: 'taux de satisfaction' },
  { value: 45, suffix: 'j', label: 'Délai moyen de vente', description: 'contre 90j en moyenne' },
  { value: 15, suffix: 'ans', label: 'D’expérience', description: 'dans l\'immobilier local' },
];

export default function StatsSection() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true });

  return (
    <section ref={ref} className="py-20 bg-dark-900 border-y border-gold-900/20">
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
          {stats.map((stat, i) => (
            <div key={i} className="text-center">
              <div className="text-4xl md:text-5xl font-bold text-gradient mb-2">
                {isInView ? (
                  <CountUp
                    end={stat.value}
                    suffix={stat.suffix}
                    duration={2.5}
                    delay={i * 0.2}
                  />
                ) : (
                  <span>0{stat.suffix}</span>
                )}
              </div>
              <div className="text-white font-semibold mb-1">{stat.label}</div>
              <div className="text-gray-500 text-sm">{stat.description}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
