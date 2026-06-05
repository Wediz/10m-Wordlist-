'use client';

import { motion } from 'framer-motion';
import { Camera, Video, Globe, Home, TrendingUp, FileText, Users, Star } from 'lucide-react';

const services = [
  {
    icon: Camera,
    title: 'Photos Professionnelles',
    description: 'Reportage photo HDR par un photographe immobilier certifié.',
    color: 'text-blue-400',
  },
  {
    icon: Video,
    title: 'Vidéo Drone 4K',
    description: 'Survol aérien de votre bien pour une mise en valeur exceptionnelle.',
    color: 'text-purple-400',
  },
  {
    icon: Globe,
    title: 'Visite Virtuelle 360°',
    description: 'Explorez chaque pièce depuis chez vous. Déplacements inutiles évités.',
    color: 'text-gold-400',
  },
  {
    icon: Home,
    title: 'Home Staging Virtuel',
    description: 'Visualisez le potentiel de votre bien avec une décoration simulée.',
    color: 'text-green-400',
  },
  {
    icon: TrendingUp,
    title: 'Diffusion Maximale',
    description: 'Publication sur +80 portails immobiliers nationaux et locaux.',
    color: 'text-red-400',
  },
  {
    icon: FileText,
    title: 'Estimation Précise',
    description: 'Analyse de marché complète basée sur les transactions récentes.',
    color: 'text-yellow-400',
  },
  {
    icon: Users,
    title: 'Accompagnement Juridique',
    description: 'Suivi complet du compromis à l\'acte avec notaire partenaire.',
    color: 'text-teal-400',
  },
  {
    icon: Star,
    title: 'Service Premium',
    description: 'Un seul interlocuteur dédié du début jusqu\'au bout.',
    color: 'text-pink-400',
  },
];

export default function ServicesSection() {
  return (
    <section id="services" className="py-24 bg-dark-950">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Nos services</span>
          <h2 className="text-4xl font-bold text-white mt-3 mb-4">
            Une offre complète, un service
            <span className="text-gradient"> d\'exception</span>
          </h2>
          <p className="text-gray-400 max-w-2xl mx-auto">
            Chaque mandat inclut l\'ensemble de nos services premium sans frais supplémentaires.
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {services.map((service, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: i * 0.1 }}
              className="glass rounded-2xl p-6 hover:border-gold-800/50 border border-transparent transition-all group"
            >
              <div className={`${service.color} mb-4`}>
                <service.icon className="w-8 h-8" />
              </div>
              <h3 className="text-white font-semibold mb-2">{service.title}</h3>
              <p className="text-gray-400 text-sm">{service.description}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
