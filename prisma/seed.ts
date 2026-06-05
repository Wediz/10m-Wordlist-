import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

async function main() {
  const property1 = await prisma.property.upsert({
    where: { slug: 'villa-prestige-royan-vue-mer' },
    update: {},
    create: {
      slug: 'villa-prestige-royan-vue-mer',
      title: 'Villa Prestige avec Vue Mer Panoramique',
      description:
        'Exceptional villa located in Royan, offering a breathtaking panoramic view of the Atlantic Ocean. This prestigious property combines contemporary architecture with premium finishes. Swimming pool, landscaped garden, 4 bedrooms, home cinema.',
      price: 1250000,
      surface: 280,
      rooms: 7,
      bedrooms: 4,
      bathrooms: 3,
      type: 'MAISON',
      status: 'AVAILABLE',
      city: 'Royan',
      postalCode: '17200',
      dpeScore: 'B',
      gesScore: 'A',
      hasPool: true,
      hasGarage: true,
      hasGarden: true,
      hasSeaView: true,
      hasTerrace: true,
      yearBuilt: 2019,
      isFeatured: true,
      isDroneShot: true,
      images: {
        create: [
          {
            url: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=1200',
            alt: 'Villa facade',
            isPrimary: true,
            order: 0,
          },
          {
            url: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200',
            alt: 'Living room',
            isPrimary: false,
            order: 1,
          },
        ],
      },
    },
  });

  const property2 = await prisma.property.upsert({
    where: { slug: 'maison-saintongeaise-saintes-centre' },
    update: {},
    create: {
      slug: 'maison-saintongeaise-saintes-centre',
      title: 'Maison Saintongeaise Rénovée — Centre Saintes',
      description:
        'Magnificent Saintongeaise house completely renovated with quality materials. Exposed stone, parquet floors, fireplace. 5 bedrooms, large walled garden, double garage. Sought-after neighborhood in Saintes.',
      price: 485000,
      surface: 195,
      rooms: 8,
      bedrooms: 5,
      bathrooms: 2,
      type: 'MAISON',
      status: 'AVAILABLE',
      city: 'Saintes',
      postalCode: '17100',
      dpeScore: 'C',
      gesScore: 'C',
      hasPool: false,
      hasGarage: true,
      hasGarden: true,
      hasSeaView: false,
      hasTerrace: true,
      yearBuilt: 1890,
      isFeatured: true,
      isDroneShot: false,
      images: {
        create: [
          {
            url: 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=1200',
            alt: 'Maison facade',
            isPrimary: true,
            order: 0,
          },
        ],
      },
    },
  });

  await prisma.blogPost.upsert({
    where: { slug: 'marche-immobilier-charente-maritime-2024' },
    update: {},
    create: {
      slug: 'marche-immobilier-charente-maritime-2024',
      title: 'Le marché immobilier en Charente-Maritime en 2024',
      excerpt:
        'Analyse complète du marché immobilier en Charente-Maritime : tendances des prix, volumes de ventes, et perspectives pour 2025.',
      content: 'Full article content here...',
      author: 'Immo Vision 17',
      tags: ['marché immobilier', 'Charente-Maritime', '2024', 'analyse'],
      publishedAt: new Date(),
    },
  });

  console.log('Seed completed:', { property1: property1.id, property2: property2.id });
}

main()
  .catch(console.error)
  .finally(() => prisma.$disconnect());
