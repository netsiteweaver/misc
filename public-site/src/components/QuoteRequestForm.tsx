"use client";

import { useState, FormEvent } from "react";
import { submitQuoteRequest, QuoteRequestData } from "@/lib/api";
import { Button } from "@/components/Button";

export function QuoteRequestForm() {
  const [formData, setFormData] = useState<QuoteRequestData>({
    part_name: "",
    quantity: 1,
    preferred_contact: "facebook",
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [message, setMessage] = useState<{
    type: "success" | "error";
    text: string;
  } | null>(null);

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setIsSubmitting(true);
    setMessage(null);

    try {
      await submitQuoteRequest(formData);
      setMessage({
        type: "success",
        text: "Quote request submitted successfully! We will respond soon.",
      });
      // Reset form
      setFormData({
        part_name: "",
        quantity: 1,
        preferred_contact: "facebook",
      });
    } catch (error: any) {
      const errorMessage =
        error?.message || "Failed to submit quote request. Please try again.";
      setMessage({
        type: "error",
        text: errorMessage,
      });
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-6">
      <div className="grid gap-4 sm:grid-cols-2">
        <div>
          <label
            htmlFor="name"
            className="block text-sm font-medium text-zinc-900"
          >
            Name (optional)
          </label>
          <input
            type="text"
            id="name"
            value={formData.name || ""}
            onChange={(e) =>
              setFormData({ ...formData, name: e.target.value })
            }
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="phone"
            className="block text-sm font-medium text-zinc-900"
          >
            Phone (optional)
          </label>
          <input
            type="tel"
            id="phone"
            value={formData.phone || ""}
            onChange={(e) =>
              setFormData({ ...formData, phone: e.target.value })
            }
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="email"
            className="block text-sm font-medium text-zinc-900"
          >
            Email (optional)
          </label>
          <input
            type="email"
            id="email"
            value={formData.email || ""}
            onChange={(e) =>
              setFormData({ ...formData, email: e.target.value })
            }
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="preferred_contact"
            className="block text-sm font-medium text-zinc-900"
          >
            Preferred Contact Method
          </label>
          <select
            id="preferred_contact"
            value={formData.preferred_contact}
            onChange={(e) =>
              setFormData({
                ...formData,
                preferred_contact: e.target.value as
                  | "facebook"
                  | "phone"
                  | "email",
              })
            }
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          >
            <option value="facebook">Facebook</option>
            <option value="phone">Phone</option>
            <option value="email">Email</option>
          </select>
        </div>
      </div>

      <div className="grid gap-4 sm:grid-cols-3">
        <div>
          <label
            htmlFor="vehicle_make"
            className="block text-sm font-medium text-zinc-900"
          >
            Vehicle Make (optional)
          </label>
          <input
            type="text"
            id="vehicle_make"
            value={formData.vehicle_make || ""}
            onChange={(e) =>
              setFormData({ ...formData, vehicle_make: e.target.value })
            }
            placeholder="e.g., Toyota"
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="vehicle_model"
            className="block text-sm font-medium text-zinc-900"
          >
            Vehicle Model (optional)
          </label>
          <input
            type="text"
            id="vehicle_model"
            value={formData.vehicle_model || ""}
            onChange={(e) =>
              setFormData({ ...formData, vehicle_model: e.target.value })
            }
            placeholder="e.g., Corolla"
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="vehicle_year"
            className="block text-sm font-medium text-zinc-900"
          >
            Year (optional)
          </label>
          <input
            type="text"
            id="vehicle_year"
            value={formData.vehicle_year || ""}
            onChange={(e) =>
              setFormData({ ...formData, vehicle_year: e.target.value })
            }
            placeholder="e.g., 2020"
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>
      </div>

      <div>
        <label
          htmlFor="engine"
          className="block text-sm font-medium text-zinc-900"
        >
          Engine (optional)
        </label>
        <input
          type="text"
          id="engine"
          value={formData.engine || ""}
          onChange={(e) =>
            setFormData({ ...formData, engine: e.target.value })
          }
          placeholder="e.g., 1.8L 4-cylinder"
          className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
        />
      </div>

      <div className="grid gap-4 sm:grid-cols-2">
        <div>
          <label
            htmlFor="part_name"
            className="block text-sm font-medium text-zinc-900"
          >
            Part Name <span className="text-red-500">*</span>
          </label>
          <input
            type="text"
            id="part_name"
            required
            value={formData.part_name}
            onChange={(e) =>
              setFormData({ ...formData, part_name: e.target.value })
            }
            placeholder="e.g., Brake pads front"
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>

        <div>
          <label
            htmlFor="quantity"
            className="block text-sm font-medium text-zinc-900"
          >
            Quantity
          </label>
          <input
            type="number"
            id="quantity"
            min="1"
            max="999"
            value={formData.quantity}
            onChange={(e) =>
              setFormData({
                ...formData,
                quantity: parseInt(e.target.value) || 1,
              })
            }
            className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
          />
        </div>
      </div>

      <div>
        <label
          htmlFor="notes"
          className="block text-sm font-medium text-zinc-900"
        >
          Additional Notes (optional)
        </label>
        <textarea
          id="notes"
          rows={4}
          value={formData.notes || ""}
          onChange={(e) =>
            setFormData({ ...formData, notes: e.target.value })
          }
          placeholder="Any additional information about the part you need..."
          className="mt-1 block w-full rounded-lg border border-zinc-300 px-3 py-2 text-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
        />
      </div>

      {message && (
        <div
          className={`rounded-lg p-4 ${
            message.type === "success"
              ? "bg-green-50 text-green-800"
              : "bg-red-50 text-red-800"
          }`}
        >
          {message.text}
        </div>
      )}

      <div className="flex gap-3">
        <Button
          type="submit"
          disabled={isSubmitting}
          className="disabled:opacity-50"
        >
          {isSubmitting ? "Submitting..." : "Submit Quote Request"}
        </Button>
      </div>
    </form>
  );
}

