# Pharmacy Management Application

This repository defines the scope and requirements for a pharmacy
management application focused on three core domains: purchases,
sales, and inventory.

## Scope: what we need to manage

### Purchases
- Supplier directory (contacts, tax info, lead times).
- Purchase orders (PO) with status workflow: draft, sent, received.
- Goods receiving (GRN) with batch/lot, expiry dates, and unit cost.
- Purchase returns and supplier credit notes.
- Landed costs (freight, taxes, duties) allocated to items.
- Payments to suppliers and outstanding balances.

### Sales
- Customer/patient directory (optional, based on privacy policy).
- Sales invoices and receipts (cash, card, insurance, credit).
- Pricing rules (MRP, discounts, promotions, insurance coverage).
- Sales returns and refunds.
- Prescription linkage where required by regulation.
- Tax handling and fiscal document numbering.

### Inventory
- Product catalog (SKU, barcode, form, strength, pack size).
- Stock by location (store, shelf, bin) with transfers.
- Batch/lot tracking and expiry management.
- Stock movements (purchase, sale, adjustment, transfer, return).
- Reorder levels and low-stock alerts.
- Stock valuation (FIFO/FEFO/weighted average).

## Core entities

| Entity | Purpose |
| --- | --- |
| Product | Master data for items (name, strength, unit, barcode). |
| Supplier | Vendor details, payment terms, tax IDs. |
| Customer | Optional patient/customer profile. |
| PurchaseOrder | Commitments to buy items from suppliers. |
| GoodsReceipt | Actual items received (batch, expiry, cost). |
| SalesInvoice | Items sold, price, taxes, discounts, payment status. |
| StockMovement | Immutable ledger of inventory changes. |
| StockBalance | Current on-hand quantity by product/location/batch. |

## Key workflows

- Create PO -> receive goods -> update stock -> pay supplier.
- Create sale -> reserve stock -> finalize invoice -> update stock.
- Return flow (sales return or purchase return) -> adjust stock.
- Periodic stock counts -> adjustment movements -> audit trail.

## Reports and controls

- Daily sales summary, gross margin, tax reports.
- Purchase history by supplier and item.
- Inventory aging and near-expiry report.
- Fast/slow movers and out-of-stock analysis.
- Audit log for all critical actions.

## Non-functional requirements

- Role-based access control (pharmacist, cashier, manager, admin).
- Backup and restore; data retention policy.
- Performance: fast search by product name and barcode.
- Compliance with local pharmacy regulations and privacy rules.

## Next steps

1. Confirm required workflows by region and regulation.
2. Decide platform (web/desktop/mobile) and tech stack.
3. Implement data model and stock ledger with tests.
4. Add UI and reporting surfaces.