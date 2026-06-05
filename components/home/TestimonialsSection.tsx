'use client';

import { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { Star, ChevronLeft, ChevronRight } from 'lucide-react';

const testimonials = [
  {
    name: 'Marie & Thomas L.',
    location: 'Saintes',
    text: 'Service exceptionnel ! La visite virtuelle a permis à nos acheteurs de tomber amoureux du bien avant même de le visiter. Vendu en 3 semaines au prix demandé.',
    rating: 5,
    type: 'Vendeur',
  },
  {
    name: 'Claire B.',
    location: 'Royan',
    text: 'J\'ai trouvé ma maison de rêve grâce à Immo Vision 17. L\'accompagnement a été irréprochable du début à la fin. Je recommande sans hésiter.',
    rating: 5,
    type: 'Acheteur',
  },
  {
    name: 'Jean-Pierre M.',
    location: 'Rochefort',
    text: 'Les photos et la vidéo drone ont sublimé mon appartement. Plus de 40 demandes en une semaine ! Professionnalisme et réactivité exemplaires.',
    rating: 5,
    type: 'Vendeur',
  },
  {
    name: 'Sophie & Marc D.',
    location: 'Saint-Jean-d\'Angély',
    text: 'Estimation très précise, vendu 8% au-dessus de l\'estimation initiale. Le home staging virtuel a vraiment fait la différence.',
    rating: 5,
    type: 'Vendeur',
  },
];

export default function TestimonialsSection() {
  const [current, setCurrent] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrent((prev) => (prev + 1) % testimonials.length);
    }, 5000);
    return () => clearInterval(timer);
  }, []);

  return (
    <section className="py-24 bg-dark-900">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Témoignages</span>
          <h2 className="text-4xl font-bold text-white mt-3">
            Ils nous font <span className="text-gradient">confiance</span>
          </h2>
        </div>

        <div className="max-w-3xl mx-auto relative">
          <AnimatePresence mode="wait">
            <motion.div
              key={current}
              initial={{ opacity: 0, x: 30 }}
              animate={{ opacity: 1, x: 0 }}
              exit={{ opacity: 0, x: -30 }}
              transition={{ duration: 0.4 }}
              className="glass-gold rounded-3xl p-10 text-center"
            >
              <div className="flex justify-center gap-1 mb-6">
                {[...Array(testimonials[current].rating)].map((_, i) => (
                  <Star key={i} className="w-5 h-5 text-gold-400 fill-gold-400" />
                ))}
              </div>
              <blockquote className="text-gray-200 text-lg leading-relaxed mb-8 italic">
                &ldquo;{testimonials[current].text}&rdquo;
              </blockquote>
              <div>
                <div className="text-white font-semibold">{testimonials[current].name}</div>
                <div className="text-gray-400 text-sm">
                  {testimonials[current].location} •{' '}
                  <span className="text-gold-400">{testimonials[current].type}</span>
                </div>
              </div>
            </motion.div>
          </AnimatePresence>

          <div className="flex items-center justify-center gap-4 mt-8">
            <button
              onClick={() => setCurrent((prev) => (prev - 1 + testimonials.length) % testimonials.length)}
              className="w-10 h-10 rounded-full glass flex items-center justify-center text-gray-400 hover:text-gold-400 transition-colors"
            >
              <ChevronLeft className="w-5 h-5" />
            </button>
            <div className="flex gap-2">
              {testimonials.map((_, i) => (
                <button
                  key={i}
                  onClick={() => setCurrent(i)}
                  className={`w-2 h-2 rounded-full transition-all ${
                    i === current ? 'bg-gold-400 w-6' : 'bg-white/20'
                  }`}
                />
              ))}
            </div>
            <button
              onClick={() => setCurrent((prev) => (prev + 1) % testimonials.length)}
              className="w-10 h-10 rounded-full glass flex items-center justify-center text-gray-400 hover:text-gold-400 transition-colors"
            >
              <ChevronRight className="w-5 h-5" />
            </button>
          </div>
        </div>
      </div>
    </section>
  );
}
