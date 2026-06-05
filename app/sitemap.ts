import { MetadataRoute } from 'next'
import { SEO_CITIES } from '@/lib/constants'

const BASE_URL = 'https://immovision17.fr'

export default function sitemap(): MetadataRoute.Sitemap {
  const staticRoutes: MetadataRoute.Sitemap = [
    { url: BASE_URL, lastModified: new Date(), changeFrequency: 'daily', priority: 1 },
    { url: `${BASE_URL}/estimation`, lastModified: new Date(), changeFrequency: 'weekly', priority: 0.9 },
    { url: `${BASE_URL}/biens`, lastModified: new Date(), changeFrequency: 'daily', priority: 0.9 },
    { url: `${BASE_URL}/contact`, lastModified: new Date(), changeFrequency: 'monthly', priority: 0.7 },
    { url: `${BASE_URL}/blog`, lastModified: new Date(), changeFrequency: 'weekly', priority: 0.7 },
    { url: `${BASE_URL}/espace-vendeur`, lastModified: new Date(), changeFrequency: 'monthly', priority: 0.6 },
    { url: `${BASE_URL}/espace-acheteur`, lastModified: new Date(), changeFrequency: 'monthly', priority: 0.6 },
  ]

  const cityRoutes: MetadataRoute.Sitemap = SEO_CITIES.map((city) => ({
    url: `${BASE_URL}/immobilier-${city.slug}`,
    lastModified: new Date(),
    changeFrequency: 'weekly',
    priority: 0.8,
  }))

  return [...staticRoutes, ...cityRoutes]
}
