// API client for Laravel backend
const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

export interface ApiError {
  message: string;
  errors?: Record<string, string[]>;
}

export interface Category {
  id: number;
  title: string;
  description: string;
  examples: string[];
  image_path?: string;
}

export interface SiteSettings {
  name: string;
  tagline: string;
  phone: string;
  email: string;
  address: string;
  hours: string;
  facebookUrl: string;
  accentColorHex: string;
}

export interface QuoteRequestData {
  name?: string;
  phone?: string;
  email?: string;
  vehicle_make?: string;
  vehicle_model?: string;
  vehicle_year?: string;
  engine?: string;
  part_name: string;
  quantity?: number;
  notes?: string;
  preferred_contact?: 'facebook' | 'phone' | 'email';
}

async function handleResponse<T>(response: Response): Promise<T> {
  const contentType = response.headers.get('content-type');
  
  if (!response.ok) {
    let error: ApiError;
    
    if (contentType?.includes('application/json')) {
      error = await response.json();
    } else {
      error = { message: `HTTP error! status: ${response.status}` };
    }
    
    throw error;
  }
  
  if (contentType?.includes('application/json')) {
    return response.json();
  }
  
  throw new Error('Invalid response format');
}

export async function fetchCategories(): Promise<Category[]> {
  const response = await fetch(`${API_BASE_URL}/categories`, {
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    cache: 'no-store', // For Next.js server components
  });
  
  return handleResponse<Category[]>(response);
}

export async function fetchSiteSettings(): Promise<SiteSettings> {
  const response = await fetch(`${API_BASE_URL}/site-settings`, {
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    cache: 'no-store', // For Next.js server components
  });
  
  return handleResponse<SiteSettings>(response);
}

export async function submitQuoteRequest(data: QuoteRequestData): Promise<{ message: string; success: boolean }> {
  const response = await fetch(`${API_BASE_URL}/quote-requests`, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  });
  
  return handleResponse<{ message: string; success: boolean }>(response);
}

