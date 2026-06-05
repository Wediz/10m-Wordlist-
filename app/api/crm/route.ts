import { NextRequest, NextResponse } from 'next/server'
import { z } from 'zod'

const dealSchema = z.object({
  title: z.string().min(2),
  stage: z.enum(['PROSPECT', 'ESTIMATION', 'VISITE', 'MANDAT', 'COMMERCIALISATION', 'COMPROMIS', 'VENDU']),
  value: z.number().optional(),
  notes: z.string().optional(),
  nextAction: z.string().optional(),
  nextActionDate: z.string().optional(),
})

export async function GET() {
  return NextResponse.json({ success: true, data: [] })
}

export async function POST(req: NextRequest) {
  try {
    const body = await req.json()
    const data = dealSchema.parse(body)
    return NextResponse.json({ success: true, data }, { status: 201 })
  } catch (error) {
    if (error instanceof z.ZodError) {
      return NextResponse.json({ success: false, error: 'Validation error' }, { status: 400 })
    }
    return NextResponse.json({ success: false, error: 'Server error' }, { status: 500 })
  }
}

export async function PATCH(req: NextRequest) {
  try {
    const { id, stage } = await req.json()
    // TODO: Update deal stage in DB
    return NextResponse.json({ success: true })
  } catch {
    return NextResponse.json({ success: false, error: 'Server error' }, { status: 500 })
  }
}
