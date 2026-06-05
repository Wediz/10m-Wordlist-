'use client';

import { TrendingUp, Users, Home, Euro } from 'lucide-react';
import { formatPrice } from '@/lib/utils';

const stats = [
  { label: 'Affaires actives', value: '24', icon: Home, color: 'text-blue-400', bg: 'bg-blue-900/30' },
  { label: 'Contacts ce mois', value: '47', icon: Users, color: 'text-purple-400', bg: 'bg-purple-900/30' },
  { label: 'CA en cours', value: formatPrice(3250000), icon: Euro, color: 'text-gold-400', bg: 'bg-gold-900/30' },
  { label: 'Taux de conversion', value: '68%', icon: TrendingUp, color: 'text-green-400', bg: 'bg-green-900/30' },
];

export default function CRMStats() {
  return (
    <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
      {stats.map((stat, i) => (
        <div key={i} className="glass rounded-2xl p-6">
          <div className={`w-10 h-10 ${stat.bg} rounded-xl flex items-center justify-center mb-4`}>
            <stat.icon className={`w-5 h-5 ${stat.color}`} />
          </div>
          <div className="text-2xl font-bold text-white mb-1">{stat.value}</div>
          <div className="text-gray-400 text-sm">{stat.label}</div>
        </div>
      ))}
    </div>
  );
}
