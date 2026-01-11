export type SiteConfig = {
  name: string;
  tagline: string;
  facebookUrl: string;
  phone?: string;
  email?: string;
  address?: string;
  hours?: string;
};

export const site: SiteConfig = {
  name: "Car Parts Shop",
  tagline: "Quality car parts. Fast sourcing. Honest pricing.",
  facebookUrl: "https://www.facebook.com/profile.php?id=100068333531889",
  // Optional (fill these in when you have them)
  phone: "",
  email: "",
  address: "",
  hours: "",
};

export type CatalogCategory = {
  title: string;
  description: string;
  examples: string[];
};

export const categories: CatalogCategory[] = [
  {
    title: "Brakes",
    description: "Pads, discs/rotors, calipers, sensors, brake fluid.",
    examples: ["Brake pads", "Rotors", "Calipers", "ABS sensors"],
  },
  {
    title: "Engine",
    description: "Service parts and components to keep you running.",
    examples: ["Filters", "Belts", "Spark plugs", "Mounts"],
  },
  {
    title: "Suspension & Steering",
    description: "Comfort, control, and safety parts.",
    examples: ["Shocks/struts", "Bushings", "Ball joints", "Tie rods"],
  },
  {
    title: "Electrical",
    description: "Starting, charging, lighting, and sensors.",
    examples: ["Batteries", "Alternators", "Starters", "Bulbs"],
  },
  {
    title: "Body & Lighting",
    description: "Exterior parts and replacements.",
    examples: ["Bumpers", "Mirrors", "Headlights", "Fenders"],
  },
  {
    title: "Fluids & Service",
    description: "Consumables and routine maintenance.",
    examples: ["Engine oil", "ATF", "Coolant", "Wipers"],
  },
];

