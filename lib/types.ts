export interface PropertyImage {
  id: string;
  url: string;
  alt: string;
  isPrimary: boolean;
  order: number;
}

export interface Property {
  id: string;
  slug: string;
  title: string;
  description: string;
  price: number;
  surface: number;
  rooms: number;
  bedrooms: number;
  bathrooms: number;
  type: string;
  status: 'available' | 'under_offer' | 'sold';
  city: string;
  address?: string;
  postalCode: string;
  latitude?: number;
  longitude?: number;
  images: PropertyImage[];
  dpeScore?: string;
  gesScore?: string;
  hasPool: boolean;
  hasGarage: boolean;
  hasGarden: boolean;
  hasSeaView: boolean;
  hasTerrace: boolean;
  yearBuilt?: number;
  landSurface?: number;
  virtualTourUrl?: string;
  videoUrl?: string;
  floorPlanUrl?: string;
  isFeatured: boolean;
  isDroneShot: boolean;
  createdAt: string;
  updatedAt: string;
}

export interface EstimationLead {
  id: string;
  firstName: string;
  lastName: string;
  email: string;
  phone: string;
  propertyType: string;
  address: string;
  city: string;
  postalCode: string;
  surface: number;
  rooms: number;
  condition: string;
  hasPool: boolean;
  hasGarage: boolean;
  hasGarden: boolean;
  additionalInfo?: string;
  estimatedValue?: number;
  status: 'pending' | 'contacted' | 'completed';
  createdAt: string;
}

export interface CRMActivity {
  id: string;
  type: 'call' | 'email' | 'visit' | 'note' | 'document';
  content: string;
  createdAt: string;
  userId: string;
}

export interface CRMDeal {
  id: string;
  title: string;
  clientName: string;
  clientEmail: string;
  clientPhone?: string;
  propertyAddress?: string;
  value: number;
  stage: string;
  priority: 'low' | 'medium' | 'high';
  notes?: string;
  activities: CRMActivity[];
  nextAction?: string;
  nextActionDate?: string;
  createdAt: string;
  updatedAt: string;
}

export interface PropertyFilters {
  type?: string;
  city?: string;
  minPrice?: number;
  maxPrice?: number;
  minSurface?: number;
  maxSurface?: number;
  minRooms?: number;
  hasPool?: boolean;
  hasSeaView?: boolean;
  status?: string;
  sortBy?: 'price_asc' | 'price_desc' | 'date_desc' | 'surface_desc';
}

export interface APIResponse<T> {
  data?: T;
  error?: string;
  message?: string;
  total?: number;
  page?: number;
  perPage?: number;
}
