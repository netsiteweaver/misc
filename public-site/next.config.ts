import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  // Removed output: "export" because we're using API routes and server-side features
  // If you need static export, you'll need to remove the /icon route and handle favicon differently
};

export default nextConfig;
