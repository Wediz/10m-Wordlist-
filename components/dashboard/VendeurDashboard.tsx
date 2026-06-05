'use client';

import { useState } from 'react';
import Image from 'next/image';
import { Eye, Calendar, MessageSquare, TrendingUp, MapPin, BarChart2 } from 'lucide-react';
import { formatPrice } from '@/lib/utils';

const mockStats = [
  { label: 'Vues cette semaine', value: '243', icon: Eye, delta: '+18%' },
  { label: 'Demandes de visite', value: '7', icon: Calendar, delta: '+3' },
  { label: 'Messages reçus', value: '12', icon: MessageSquare, delta: '+5' },
  { label: 'Annonces publiées', value: '3', icon: BarChart2, delta: '' },
];

const mockVisits = [
  { date: '2024-07-15 14h00', name: 'M. et Mme Martin', status: 'confirmée' },
  { date: '2024-07-17 10h30', name: 'M. Dubois', status: 'en attente' },
  { date: '2024-07-19 16h00', name: 'Mme Garcia', status: 'confirmée' },
];

export default function VendeurDashboard() {
  const [activeTab, setActiveTab] = useState('overview');

  return (
    <div className="space-y-8">
      {/* Property card */}
      <div className="glass rounded-2xl overflow-hidden">
        <div className="relative h-48">
          <Image
            src="https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800"
            alt="Votre bien"
            fill
            className="object-cover"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent" />
          <div className="absolute bottom-4 left-4">
            <h3 className="text-white font-bold text-xl">Villa Prestige Vue Mer</h3>
            <div className="flex items-center gap-1 text-gray-300 text-sm">
              <MapPin className="w-3 h-3" /> Royan, 17200
            </div>
          </div>
          <div className="absolute bottom-4 right-4">
            <span className="text-2xl font-bold text-gradient">{formatPrice(1250000)}</span>
          </div>
        </div>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {mockStats.map((stat, i) => (
          <div key={i} className="glass rounded-2xl p-5">
            <div className="flex items-center justify-between mb-3">
              <stat.icon className="w-5 h-5 text-gold-400" />
              {stat.delta && (
                <span className="text-green-400 text-xs">{stat.delta}</span>
              )}
            </div>
            <div className="text-2xl font-bold text-white">{stat.value}</div>
            <div className="text-gray-400 text-xs mt-1">{stat.label}</div>
          </div>
        ))}
      </div>

      {/* Visits */}
      <div className="glass rounded-2xl p-6">
        <h3 className="text-white font-semibold mb-4 flex items-center gap-2">
          <Calendar className="w-5 h-5 text-gold-400" /> Prochaines visites
        </h3>
        <div className="space-y-3">
          {mockVisits.map((v, i) => (
            <div key={i} className="flex items-center justify-between py-3 border-b border-white/5 last:border-0">
              <div>
                <div className="text-white text-sm font-medium">{v.name}</div>
                <div className="text-gray-400 text-xs">{v.date}</div>
              </div>
              <span
                className={`text-xs px-3 py-1 rounded-full ${
                  v.status === 'confirmée'
                    ? 'bg-green-900/50 text-green-400'
                    : 'bg-yellow-900/50 text-yellow-400'
                }`}
              >
                {v.status}
              </span>
            </div>
          ))}
        </div>
      </div>

      {/* Marketing performance */}
      <div className="glass rounded-2xl p-6">
        <h3 className="text-white font-semibold mb-4 flex items-center gap-2">
          <TrendingUp className="w-5 h-5 text-gold-400" /> Performance marketing
        </h3>
        <div className="space-y-3">
          {[
            { portal: 'SeLoger', views: 89, percentage: 37 },
            { portal: 'Leboncoin', views: 67, percentage: 28 },
            { portal: 'Logic-Immo', views: 45, percentage: 19 },
            { portal: 'PAP', views: 28, percentage: 12 },
            { portal: 'Autres', views: 14, percentage: 4 },
          ].map((item) => (
            <div key={item.portal}>
              <div className="flex justify-between text-sm mb-1">
                <span className="text-gray-300">{item.portal}</span>
                <span className="text-gold-400">{item.views} vues</span>
              </div>
              <div className="h-2 bg-white/5 rounded-full overflow-hidden">
                <div
                  className="h-full bg-gradient-to-r from-gold-600 to-gold-400 rounded-full"
                  style={{ width: `${item.percentage}%` }}
                />
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
