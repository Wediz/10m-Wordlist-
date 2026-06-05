import { Metadata } from 'next';
import { notFound } from 'next/navigation';
import Link from 'next/link';
import { MapPin, TrendingUp, Home, ArrowRight } from 'lucide-react';
import { SEO_CITIES } from '@/lib/constants';

export async function generateStaticParams() {
  return SEO_CITIES.map((city) => ({ city: city.slug }));
}

export async function generateMetadata({ params }: { params: { city: string } }): Promise<Metadata> {
  const city = SEO_CITIES.find((c) => c.slug === params.city);
  if (!city) return {};
  return {
    title: `Immobilier ${city.name} | Achat Vente Estimation | Immo Vision 17`,
    description: `Expert immobilier à ${city.name} (Charente-Maritime). Achat, vente, estimation gratuite. ${city.properties} biens disponibles. Prix moyen : ${city.avgPrice}€/m².`,
  };
}

export default function CityPage({ params }: { params: { city: string } }) {
  const city = SEO_CITIES.find((c) => c.slug === params.city);
  if (!city) notFound();

  return (
    <main className="min-h-screen bg-dark-950 pt-28 pb-20">
      <div className="container mx-auto px-4">
        {/* Hero */}
        <div className="text-center mb-16">
          <div className="flex items-center justify-center gap-2 text-gold-400 text-sm font-semibold tracking-widest uppercase mb-4">
            <MapPin className="w-4 h-4" />
            Charente-Maritime (17)
          </div>
          <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">
            Immobilier <span className="text-gradient">{city.name}</span>
          </h1>
          <p className="text-gray-400 max-w-2xl mx-auto text-lg">
            {city.description}. Votre expert immobilier local pour acheter, vendre ou estimer votre bien.
          </p>
        </div>

        {/* Market stats */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
          {[
            { label: 'Prix moyen', value: `${city.avgPrice}¬/m²`, icon: TrendingUp, color: 'text-gold-400' },
            { label: 'Évolution 1 an', value: city.priceEvolution, icon: TrendingUp, color: 'text-green-400' },
            { label: 'Biens disponibles', value: `${city.properties}`, icon: Home, color: 'text-blue-400' },
            { label: 'Population', value: city.population, icon: MapPin, color: 'text-purple-400' },
          ].map((stat, i) => (
            <div key={i} className="glass rounded-2xl p-6 text-center">
              <stat.icon className={`w-6 h-6 ${stat.color} mx-auto mb-3`} />
              <div className="text-2xl font-bold text-white mb-1">{stat.value}</div>
              <div className="text-gray-400 text-sm">{stat.label}</div>
            </div>
          ))}
        </div>

        {/* CTA */}
        <div className="glass-gold rounded-3xl p-10 text-center mb-16">
          <h2 className="text-3xl font-bold text-white mb-4">
            Votre bien à {city.name} ?
          </h2>
          <p className="text-gray-300 mb-8">
            Obtenez une estimation gratuite et précise basée sur les transactions récentes à {city.name}.
          </p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <Link href="/estimation" className="btn-gold">
              Estimation gratuite
            </Link>
            <Link href="/biens" className="btn-outline flex items-center gap-2">
              Voir les biens <ArrowRight className="w-4 h-4" />
            </Link>
          </div>
        </div>

        {/* Long-form SEO content */}
        <div className="max-w-4xl mx-auto">
          <h2 className="text-2xl font-bold text-white mb-6">
            Le marché immobilier à {city.name}
          </h2>
          <div className="space-y-4 text-gray-400">
            <p>
              {city.name} est une ville dynamique de Charente-Maritime ({city.population} habitants)
              où le marché immobilier se caractérise par des prix accessibles et une demande soutenue.
              Le prix moyen au mètre carré y est de {city.avgPrice}€, avec une évolution de {city.priceEvolution}
              sur les 12 derniers mois.
            </p>
            <p>
              Immo Vision 17, votre consultant immobilier indépendant en Charente-Maritime, vous accompagne
              dans tous vos projets immobiliers à {city.name} et dans tout le département 17.
              Que vous souhaitiez acheter, vendre ou estimer votre bien, notre expertise locale
              et notre approche premium font la différence.
            </p>
            <p>
              Notre offre inclut la visite virtuelle 360°, le drone 4K, les photos professionnelles
              et la diffusion sur plus de 80 portails immobiliers. Chaque mandat bénéficie d\'un
              accompagnement personnalisé du début à la fin de la transaction.
            </p>
          </div>

          {/* Other cities */}
          <div className="mt-12 pt-8 border-t border-white/5">
            <h3 className="text-white font-semibold mb-4">Autres secteurs</h3>
            <div className="flex flex-wrap gap-3">
              {SEO_CITIES.filter((c) => c.slug !== city.slug).map((c) => (
                <Link
                  key={c.slug}
                  href={`/immobilier-${c.slug}`}
                  className="glass px-4 py-2 rounded-full text-sm text-gray-300 hover:text-gold-400 transition-colors"
                >
                  {c.name}
                </Link>
              ))}
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}
