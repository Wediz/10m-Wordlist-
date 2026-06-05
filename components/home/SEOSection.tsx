import Link from 'next/link';
import { SEO_CITIES } from '@/lib/constants';
import { MapPin, TrendingUp, Home } from 'lucide-react';

export default function SEOSection() {
  return (
    <section className="py-24 bg-dark-900">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Nos secteurs</span>
          <h2 className="text-4xl font-bold text-white mt-3">
            Immobilier en <span className="text-gradient">Charente-Maritime</span>
          </h2>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-16">
          {SEO_CITIES.slice(0, 5).map((city) => (
            <Link
              key={city.slug}
              href={`/immobilier-${city.slug}`}
              className="glass rounded-xl p-5 hover:border-gold-800/50 border border-transparent transition-all group text-center"
            >
              <MapPin className="w-6 h-6 text-gold-400 mx-auto mb-3" />
              <h3 className="text-white font-semibold group-hover:text-gold-400 transition-colors">
                {city.name}
              </h3>
              <div className="text-gray-400 text-xs mt-1">{city.properties} biens</div>
              <div className="text-gold-400 text-xs mt-1">{city.avgPrice}€/m²</div>
            </Link>
          ))}
        </div>

        {/* Long-form SEO text */}
        <div className="max-w-4xl mx-auto prose prose-invert prose-gold">
          <h2 className="text-2xl font-bold text-white mb-4">
            L\'immobilier en Charente-Maritime avec Immo Vision 17
          </h2>
          <p className="text-gray-400">
            Spécialiste de l\'immobilier en Charente-Maritime depuis plus de 15 ans, Immo Vision 17 vous accompagne
            dans tous vos projets d\'achat et de vente immobilière dans le département 17. De Saintes à Royan,
            en passant par Rochefort, Saint-Jean-d\'Angély et Cognac, notre expertise locale vous garantit
            une transaction réussie.
          </p>
          <p className="text-gray-400 mt-4">
            Notre approche unique combine les dernières technologies (visite virtuelle 360°, drone 4K,
            home staging digital) avec un accompagnement humain et personnalisé. Chaque bien bénéficie
            d\'une mise en valeur optimale pour attirer les acquiséreurs qualifiés et conclure la vente
            dans les meilleurs délais.
          </p>
        </div>
      </div>
    </section>
  );
}
