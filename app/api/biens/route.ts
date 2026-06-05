import { NextRequest, NextResponse } from 'next/server'

export async function GET(req: NextRequest) {
  const { searchParams } = new URL(req.url)
  // TODO: Replace with real DB query using Prisma
  return NextResponse.json({ success: true, data: [], meta: { page: 1, limit: 12, total: 0 } })
}

export async function POST(req: NextRequest) {
  try {
    const body = await req.json()
    return NextResponse.json({ success: true, data: body }, { status: 201 })
  } catch {
    return NextResponse.json({ success: false, error: 'Server error' }, { status: 500 })
  }
}
