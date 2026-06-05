import { NextRequest, NextResponse } from 'next/server'
import { z } from 'zod'

const estimationSchema = z.object({
  type: z.enum(['MAISON', 'APPARTEMENT', 'TERRAIN', 'VILLA', 'AUTRE']),
  address: z.string().min(5),
  city: z.string().min(2),
  zipCode: z.string().optional(),
  surface: z.number().min(1),
  terrain: z.number().optional(),
  rooms: z.number().min(1),
  bedrooms: z.number().min(0),
  yearBuilt: z.number().optional(),
  hasGarden: z.boolean().optional(),
  hasPool: z.boolean().optional(),
  hasGarage: z.boolean().optional(),
  condition: z.enum(['NEUF', 'BON_ETAT', 'A_RAFRAICHIR', 'A_RENOVER']),
  project: z.enum(['URGENT', 'DANS_3_MOIS', 'DANS_6_MOIS', 'PLUS_DE_6_MOIS', 'REFLEXION']),
  firstName: z.string().min(2),
  lastName: z.string().min(2),
  email: z.string().email(),
  phone: z.string().min(10),
})

export async function POST(req: NextRequest) {
  try {
    const body = await req.json()
    const data = estimationSchema.parse(body)
    // TODO: Save to DB + send email via Resend + push to CRM
    console.log('[ESTIMATION] New lead:', data.firstName, data.lastName, data.email)
    return NextResponse.json({ success: true, message: 'Estimation request received' }, { status: 201 })
  } catch (error) {
    if (error instanceof z.ZodError) {
      return NextResponse.json({ success: false, error: 'Validation error', details: error.errors }, { status: 400 })
    }
    return NextResponse.json({ success: false, error: 'Internal server error' }, { status: 500 })
  }
}
