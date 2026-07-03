<style>
    @page {
        margin: 6mm 8mm;
    }

    .ar-doc, .ar-doc * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .ar-doc {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #111;
    }

    .ar-doc .page {
        width: 730px;
        max-width: 100%;
        padding: 16px 18px;
        border: 1.5px solid #222;
        margin: 0 auto 20px;
    }

    .ar-doc .tick-row {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .ar-doc .tick-row td {
        vertical-align: top;
        white-space: normal;
    }

    .ar-doc .page-break {
        page-break-after: always;
    }

    /* Title */
    .ar-doc .title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #1a3c8f;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    /* Field rows */
    .ar-doc .field {
        margin-bottom: 10px;
    }

    .ar-doc .field-label {
        font-weight: bold;
    }

    .ar-doc .underline {
        display: inline-block;
        max-width: 100%;
        border-bottom: 1px solid #333;
        min-width: 300px;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .ar-doc .underline-full {
        display: block;
        border-bottom: 1px solid #333;
        width: 100%;
        margin-top: 2px;
        padding-bottom: 1px;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .ar-doc .field-value {
        font-weight: normal;
        max-width: 100%;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    /* Two column layout via table */
    .ar-doc .two-col {
        width: 100%;
    }

    .ar-doc .two-col td {
        vertical-align: top;
        padding: 0 0 10px 0;
    }

    /* DOB / Aadhaar boxes */
    .ar-doc .box-group {
        display: inline-block;
    }

    .ar-doc .char-box {
        display: inline-block;
        width: 18px;
        height: 20px;
        border: 1.5px solid #444;
        text-align: center;
        line-height: 18px;
        font-size: 12px;
        margin-right: 1px;
    }

    .ar-doc .box-sep {
        display: inline-block;
        width: 8px;
    }

    .ar-doc .tick-box {
        display: inline-block;
        position: relative;
        width: 13px;
        height: 13px;
        border: 1.3px solid #444;
        margin-right: 4px;
        vertical-align: middle;
        background: #fff;
    }

    .ar-doc .tick-box.checked {
        border-color: #1a3c8f;
    }

    .ar-doc .tick-box.checked .tick-mark {
        position: absolute;
        left: 3px;
        top: -1px;
        width: 4px;
        height: 8px;
        border: solid #1a3c8f;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .ar-doc .underline-value {
        display: inline-block;
        max-width: 100%;
        border-bottom: 1px solid #333;
        padding-bottom: 1px;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    /* Education table */
    .ar-doc .edu-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 6px;
        font-size: 11.5px;
    }

    .ar-doc .edu-table th {
        background-color: #1a3c8f;
        color: #fff;
        padding: 7px 8px;
        text-align: center;
        font-size: 11px;
        font-weight: bold;
        text-transform: uppercase;
        border: 1px solid #888;
    }

    .ar-doc .edu-table td {
        border: 1px solid #bbb;
        padding: 7px 8px;
        text-align: center;
        min-height: 26px;
    }

    .ar-doc .edu-table td.row-label {
        font-weight: bold;
        background: #f0f4fc;
    }

    /* Section head */
    .ar-doc .section-head {
        font-weight: bold;
        margin: 14px 0 8px;
        padding-bottom: 3px;
    }

    .ar-doc .sub-head {
        font-weight: bold;
        color: #1a3c8f;
        margin: 10px 0 6px;
        font-size: 12px;
    }

    /* Page 2 */
    .ar-doc .terms-title {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        text-decoration: underline;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 12px;
    }

    .ar-doc .terms-list {
        padding-left: 0;
        list-style: none;
    }

    .ar-doc .terms-list li {
        margin-bottom: 5px;
        text-align: justify;
        line-height: 1.4;
    }

    .ar-doc .sub-list {
        padding-left: 16px;
        list-style: none;
        margin-top: 3px;
    }

    .ar-doc .sub-list li {
        margin-bottom: 3px;
    }

    .ar-doc .decl-title {
        text-align: center;
        font-size: 13px;
        font-weight: bold;
        text-decoration: underline;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin: 14px 0 10px;
    }

    .ar-doc hr.divider {
        border: none;
        border-top: 1.5px solid #222;
        margin: 14px 0;
    }

    /* Signatures */
    .ar-doc .sign-table {
        width: 100%;
        margin-top: 18px;
    }

    .ar-doc .sign-table td {
        vertical-align: top;
        padding: 0;
    }

    .ar-doc .sign-line {
        display: block;
        border-bottom: 1px solid #333;
        margin-top: 16px;
        width: 100%;
    }

    .ar-doc .sign-label {
        font-weight: bold;
        font-size: 12px;
    }
</style>
