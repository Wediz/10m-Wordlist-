# Immo Vision 17

Ultra-premium real estate SaaS for an independent consultant in Charente-Maritime (France).

## Tech Stack

- **Next.js 14** (App Router, TypeScript)
- **Tailwind CSS** with custom gold/dark design system
- **Framer Motion** animations
- **Prisma ORM** + PostgreSQL
- **NextAuth.js** (Google + Credentials)
- **React Hook Form + Zod** validation
- **Resend** email API

## Quick Start

```bash
npm install
cp .env.example .env.local
# Fill in your env vars
npm run dev
```

## Deployment on Vercel

1. Import `wediz/10m-wordlist-` on Vercel
2. Framework: **Next.js** (auto-detected)
3. Branch: `claude/immo-vision-17-saas-vvtO4`
4. Add minimum env var: `NEXTAUTH_SECRET` = any long random string
5. Deploy

## Environment Variables

See `.env.example` for all required variables.

Minimum for first deploy:
- `NEXTAUTH_SECRET` — random string (e.g. `openssl rand -base64 32`)
- `NEXTAUTH_URL` — your Vercel URL

For full functionality:
- `DATABASE_URL` — PostgreSQL connection string (Supabase recommended)
- `RESEND_API_KEY` — for contact/estimation email notifications
- `GOOGLE_CLIENT_ID` / `GOOGLE_CLIENT_SECRET` — for Google OAuth

## Features

- Property listings with filters, gallery, virtual tour
- CRM Kanban pipeline (7 stages, drag & drop)
- Vendor & buyer dashboards
- 4-step estimation form
- Contact form with Zod validation
- SEO pages for 8 Charente-Maritime cities
- Blog with 6 articles
- PWA manifest
- Auto-generated sitemap & robots.txt
- Glassmorphism design (dark + gold)
