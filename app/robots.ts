import { MetadataRoute } from 'next'

export default function robots(): MetadataRoute.Robots {
  return {
    rules: [
      {
        userAgent: '*',
        allow: '/',
        disallow: ['/crm', '/api/', '/espace-vendeur/settings', '/_next/'],
      },
    ],
    sitemap: 'https://immovision17.fr/sitemap.xml',
  }
}
