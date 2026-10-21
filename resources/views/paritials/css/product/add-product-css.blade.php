<style>

.select2-container--default .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaaaaa6e;
    border-top-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 1px;
    border-left-width: 1px;
  border-radius: 4px;
  cursor: text;
}
   .color {
  width: 25px !important;
  height: 25px !important;
  border-radius: 50%;
  border: none;
  background-color: transparent;
}

        .invalid-feedback-custom {
            display: none;
            color: #dc3545;
            font-size: 1.05rem;
            margin-top: 0.25rem;
        }
        form.validation-attempted :invalid ~ .invalid-feedback-custom,
        form.validation-attempted .invalid-field ~ .invalid-feedback-custom {
            display: block !important;
        }

        /* Mobile alignment & line spacing adjustments */
        .digital-add .form-group {
            margin-bottom: 1rem;
        }
        .digital-add .form-label {
            margin-bottom: 0.35rem !important;
            display: inline-block;
        }
        @media (max-width: 767.98px) {
            .digital-add .form-group {
                margin-bottom: 1rem !important;
            }
            .digital-add .form-label {
                margin-bottom: 0.35rem !important;
            }
        }

        /* Inline Variant Size Rows: Always keep '+' button on the LAST row */
        .variant-card .variant-fields-wrapper .add-size-row-inline-btn {
            display: none !important;
        }
        .variant-card .variant-fields-wrapper .remove-size-row-inline-btn {
            display: inline-block !important;
        }
        .variant-card .variant-fields-wrapper:first-of-type .remove-size-row-inline-btn,
        .variant-card .variant-fields-wrapper.is-first-row .remove-size-row-inline-btn {
            display: none !important;
        }
        .variant-card .variant-fields-wrapper:not(:has(~ .variant-fields-wrapper)) .add-size-row-inline-btn,
        .variant-card .variant-fields-wrapper.is-last-row .add-size-row-inline-btn {
            display: inline-block !important;
        }

        @media (max-width: 767.98px) {
            /* On mobile, show action buttons in separate rows instead of side-by-side */
            .variant-card .variant-fields-wrapper .actions-col-wrapper > div,
            .variant-card .variant-fields-wrapper .actions-col-wrapper .d-flex,
            .variant-card .variant-fields-wrapper .col-md-1:has(.add-size-row-inline-btn, .remove-size-row-inline-btn) > div:last-child,
            .variant-card .variant-fields-wrapper .col-md-1:has(.add-size-row-inline-btn, .remove-size-row-inline-btn) .d-flex {
                flex-direction: column !important;
                gap: 0.5rem !important;
                width: 100% !important;
            }

            .variant-card .variant-fields-wrapper .actions-col-wrapper button,
            .variant-card .variant-fields-wrapper .col-md-1:has(.add-size-row-inline-btn, .remove-size-row-inline-btn) button {
                width: 100% !important;
            }

            /* On mobile, hide the action column on non-last first row so it doesn't leave an empty blank block */
            .variant-card .variant-fields-wrapper:first-of-type:has(~ .variant-fields-wrapper) .actions-col-wrapper,
            .variant-card .variant-fields-wrapper:first-of-type:has(~ .variant-fields-wrapper) .col-md-1:has(.add-size-row-inline-btn, .remove-size-row-inline-btn),
            .variant-card .variant-fields-wrapper.is-first-row:not(.is-last-row) .actions-col-wrapper,
            .variant-card .variant-fields-wrapper.is-first-row:not(.is-last-row) .col-md-1:has(.add-size-row-inline-btn, .remove-size-row-inline-btn),
            .variant-card .variant-fields-wrapper .d-none-mobile-actions {
                display: none !important;
            }

            .variant-card .variant-fields-wrapper ~ .variant-fields-wrapper {
                border-top: 1px dashed #dee2e6;
                padding-top: 15px;
                margin-top: 15px;
            }

            /* Specifications Section Mobile Optimization */
            table:has(.spectable),
            .table:has(.spectable),
            .spectable-table {
                border: none !important;
                margin-bottom: 0 !important;
            }

            .table:has(.spectable) > :not(caption) > * > *,
            .spectable td,
            .spectable th {
                border-width: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }

            .spectable {
                display: block !important;
                width: 100% !important;
            }

            .spectable tr {
                display: flex !important;
                flex-direction: column !important;
                width: 100% !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                background: transparent !important;
            }

            .spectable td {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                background: transparent !important;
            }

            .spectable td.empty-spec-td,
            .spectable td:empty {
                display: none !important;
            }

            /* Specification Label */
            .spectable td.spec-label-col,
            .spectable td:not(:has(select)):not(:has(input)) {
                display: block !important;
                font-weight: 700 !important;
                font-size: 0.95rem !important;
                color: #212529 !important;
                margin-top: 0.5rem !important;
                margin-bottom: 0.35rem !important;
                padding: 0 !important;
            }

            /* Specification Input/Select */
            .spectable td.spec-value-col,
            .spectable td:has(select),
            .spectable td:has(input) {
                display: block !important;
                width: 100% !important;
                margin-bottom: 0.85rem !important;
                padding: 0 !important;
            }

            .spectable td select,
            .spectable td .form-control {
                width: 100% !important;
                display: block !important;
                border-radius: 0.35rem !important;
                min-height: 38px !important;
                padding: 0.45rem 0.75rem !important;
                font-size: 0.95rem !important;
            }
        }
    </style>