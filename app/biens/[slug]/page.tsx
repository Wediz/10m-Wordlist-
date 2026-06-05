import type { Metadata } from 'next'
import { notFound } from 'next/navigation'
import { PropertyGallery } from '@/components/biens/PropertyGallery'
import { PropertyDetail } from '@/components/biens/PropertyDetail'

const MOCK_PROPERTY = {
  id: '1',
  slug: 'villa-piscine-royan-2024',
  title: 'Villa contemporaine avec piscine',
  description: `Superbe villa contemporaine de 185 m² située dans un quartier calme et résidentiel de Royan, à 10 minutes à pied des plages. Cette propriété d'exception offre des prestations haut de gamme alliant confort moderne et architecture soignée.

Au rez-de-chaussée, un vaste salon-séjour de 60 m² s'ouvre sur la terrasse et le jardin paysagé. La cuisine aménagée et équipée de marque Boffi est un bijou de fonctionnalité et d'esthétisme.

À l'étage, 4 chambres dont une suite parentale avec dressing et salle de bain privative. Chaque chambre dispose de sa propre salle d'eau.`,
  city: 'Royan',
  zipCode: '17200',
  address: '15 allée des Pins, Royan',
  lat: 45.6198,
  lng: -1.0278,
  price: 895000,
  surface: 185,
  terrain: 650,
  rooms: 6,
  bedrooms: 4,
  bathrooms: 3,
  floor: null,
  yearBuilt: 2018,
  hasPool: true,
  hasGarage: true,
  hasGarden: true,
  hasSeaView: false,
  hasTerrace: true,
  heating: 'Pompe à chaleur + plancher chauffant',
  orientation: 'Sud-Ouest',
  dpeScore: 'B',
  gesScore: 'A',
  annualEnergy: 1850,
  virtualTourUrl: 'https://my.matterport.com/show/?m=example',
  videoUrl: 'https://www.youtube.com/embed/dQw4w9WgXcQ',
  images: [
    { id: '1', url: 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1200&q=80', alt: 'Façade principale' },
    { id: '2', url: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&q=80', alt: 'Piscine et terrasse' },
    { id: '3', url: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=80', alt: 'Salon séjour' },
    { id: '4', url: 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1200&q=80', alt: 'Cuisine' },
    { id: '5', url: 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=1200&q=80', alt: 'Suite parentale' },
    { id: '6', url: 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=1200&q=80', alt: 'Salle de bain' },
  ],
  type: 'VILLA' as const,
  status: 'AVAILABLE' as const,
  exclusive: true,
  featured: true,
}

export async function generateMetadata({ params }: { params: { slug: string } }): Promise<Metadata> {
  return {
    title: `${MOCK_PROPERTY.title} — ${MOCK_PROPERTY.city}`,
    description: MOCK_PROPERTY.description.slice(0, 160),
    openGraph: { images: [{ url: MOCK_PROPERTY.images[0].url }] },
  }
}

export default function PropertyPage({ params }: { params: { slug: string } }) {
  if (params.slug !== MOCK_PROPERTY.slug) notFound()
  return (
    <div className="min-h-screen pt-20">
      <div className="fixed inset-0 -z-10 bg-dark-900" />
      <PropertyGallery images={MOCK_PROPERTY.images} />
      <PropertyDetail property={MOCK_PROPERTY} />
    </div>
  )
}
