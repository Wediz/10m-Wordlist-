import { Metadata } from 'next';
import Link from 'next/link';
import Image from 'next/image';
import { Calendar, Tag, ArrowRight } from 'lucide-react';
import { SEO_CITIES } from '@/lib/constants';

export const metadata: Metadata = {
  title: 'Blog Immobilier | Conseils & Actualités | Immo Vision 17',
  description: 'Conseils immobiliers, tendances du marché en Charente-Maritime, guides pratiques pour acheteurs et vendeurs.',
};

const articles = [
  {
    slug: 'marche-immobilier-charente-maritime-2024',
    title: 'Marché immobilier Charente-Maritime 2024 : bilan et perspectives',
    excerpt: 'Analyse des tendances de prix, volumes de ventes et secteurs porteurs dans le département 17 pour 2024.',
    image: 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800',
    date: '2024-06-15',
    tags: ['marché', 'analyse'],
    readTime: '6 min',
  },
  {
    slug: 'vendre-bien-immobilier-charente-maritime',
    title: 'Comment vendre votre bien au meilleur prix en Charente-Maritime',
    excerpt: 'Les étapes clés pour réussir votre vente immobilière : estimation, préparation, mise en valeur et négociation.',
    image: 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800',
    date: '2024-05-28',
    tags: ['vente', 'conseils'],
    readTime: '8 min',
  },
  {
    slug: 'visite-virtuelle-immobilier-avantages',
    title: 'Visite virtuelle 360° : pourquoi c\'est indispensable pour vendre',
    excerpt: 'La visite virtuelle révolutionne l\'immobilier. Découvrez pourquoi 76% des acheteurs l\'exigent désormais.',
    image: 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800',
    date: '2024-05-10',
    tags: ['technologie', 'visite virtuelle'],
    readTime: '5 min',
  },
  {
    slug: 'investissement-locatif-royan-17',
    title: 'Investissement locatif à Royan et sur le littoral charentais',
    excerpt: 'Rentabilité, zones tendues, fiscalité... Tout ce que vous devez savoir sur l\'investissement locatif côte atlantique.',
    image: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
    date: '2024-04-22',
    tags: ['investissement', 'Royan'],
    readTime: '10 min',
  },
  {
    slug: 'dpe-immobilier-guide-complet',
    title: 'DPE 2024 : ce qui change et son impact sur la valeur de votre bien',
    excerpt: 'Le nouveau DPE réforme les diagnostics énergétiques. Impact sur les prix, les locations et les travaux à prévoir.',
    image: 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800',
    date: '2024-04-05',
    tags: ['DPE', 'énergie'],
    readTime: '7 min',
  },
  {
    slug: 'taux-immobiliers-2024-emprunter',
    title: 'Taux immobiliers 2024 : faut-il encore emprunter ?',
    excerpt: 'Évolution des taux, pouvoir d\'achat immobilier, conseils pour optimiser votre financement en 2024.',
    image: 'https://images.unsplash.com/photo-1579621970795-87facc2f976d?w=800',
    date: '2024-03-18',
    tags: ['financement', 'taux'],
    readTime: '9 min',
  },
];

export default function BlogPage() {
  return (
    <main className="min-h-screen bg-dark-950 pt-28 pb-20">
      <div className="container mx-auto px-4">
        {/* Header */}
        <div className="text-center mb-16">
          <span className="text-gold-400 text-sm font-semibold tracking-widest uppercase">Blog</span>
          <h1 className="text-4xl md:text-5xl font-bold text-white mt-3 mb-4">
            Conseils & Actualités
            <span className="text-gradient"> Immobilières</span>
          </h1>
          <p className="text-gray-400 max-w-2xl mx-auto">
            Tendances du marché, conseils pratiques et actualités de l\'immobilier en Charente-Maritime.
          </p>
        </div>

        {/* Articles grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
          {articles.map((article) => (
            <Link
              key={article.slug}
              href={`/blog/${article.slug}`}
              className="glass rounded-2xl overflow-hidden hover:border-gold-800/50 border border-transparent transition-all group"
            >
              <div className="relative h-52 overflow-hidden">
                <Image
                  src={article.image}
                  alt={article.title}
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-500"
                />
              </div>
              <div className="p-6">
                <div className="flex items-center gap-4 text-xs text-gray-500 mb-3">
                  <span className="flex items-center gap-1">
                    <Calendar className="w-3 h-3" />
                    {new Date(article.date).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' })}
                  </span>
                  <span>{article.readTime} de lecture</span>
                </div>
                <h2 className="text-white font-semibold mb-2 group-hover:text-gold-400 transition-colors line-clamp-2">
                  {article.title}
                </h2>
                <p className="text-gray-400 text-sm line-clamp-2 mb-4">{article.excerpt}</p>
                <div className="flex items-center justify-between">
                  <div className="flex gap-2">
                    {article.tags.slice(0, 2).map((tag) => (
                      <span key={tag} className="text-xs glass px-2 py-1 rounded-full text-gold-400">
                        {tag}
                      </span>
                    ))}
                  </div>
                  <ArrowRight className="w-4 h-4 text-gold-400 group-hover:translate-x-1 transition-transform" />
                </div>
              </div>
            </Link>
          ))}
        </div>

        {/* SEO city links */}
        <div className="border-t border-white/5 pt-12">
          <h2 className="text-xl font-bold text-white mb-6">Immobilier par ville</h2>
          <div className="flex flex-wrap gap-3">
            {SEO_CITIES.map((city) => (
              <Link
                key={city.slug}
                href={`/immobilier-${city.slug}`}
                className="glass px-4 py-2 rounded-full text-sm text-gray-300 hover:text-gold-400 hover:border-gold-800/50 border border-transparent transition-all"
              >
                Immobilier {city.name}
              </Link>
            ))}
          </div>
        </div>
      </div>
    </main>
  );
}
