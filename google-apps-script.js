/**
 * Google Apps Script — Summit Invite → Google Sheets
 *
 * SETUP STEPS (do this in script.google.com):
 * 1. Open your Google Sheet → Extensions → Apps Script
 * 2. Paste this entire file into the editor
 * 3. Click Deploy → New deployment → Web app
 *    - Execute as: Me
 *    - Who has access: Anyone
 * 4. Copy the Web App URL
 * 5. Add to wp-config.php:
 *    define( 'SI_GOOGLE_SCRIPT_URL', 'PASTE_YOUR_URL_HERE' );
 */

const SHEET_NAME = 'Registrations'; // Change if your sheet tab has a different name

function doPost(e) {
  try {
    const data = JSON.parse(e.postData.contents);

    const ss    = SpreadsheetApp.getActiveSpreadsheet();
    let sheet   = ss.getSheetByName(SHEET_NAME);

    // Auto-create the sheet + header row if it doesn't exist yet
    if (!sheet) {
      sheet = ss.insertSheet(SHEET_NAME);
      sheet.appendRow([
        'Submission Date',
        'Full Name',
        'Email',
        'Phone',
        'Organization',
        'Job Title',
        'Special Requests',
      ]);
      // Bold the header row
      sheet.getRange(1, 1, 1, 7).setFontWeight('bold');
    }

    sheet.appendRow([
      data.date         || '',
      data.full_name    || '',
      data.email        || '',
      data.phone        || '',
      data.organization || '',
      data.job_title    || '',
      data.requests     || '',
    ]);

    return ContentService
      .createTextOutput(JSON.stringify({ status: 'ok' }))
      .setMimeType(ContentService.MimeType.JSON);

  } catch (err) {
    return ContentService
      .createTextOutput(JSON.stringify({ status: 'error', message: err.toString() }))
      .setMimeType(ContentService.MimeType.JSON);
  }
}

// Optional: test this function manually in the Apps Script editor
function testDoPost() {
  const fakeEvent = {
    postData: {
      contents: JSON.stringify({
        date:         '2025-09-01 10:00:00',
        full_name:    'Jane Smith',
        email:        'jane@example.com',
        phone:        '+1 555 000 0000',
        organization: 'Acme Corp',
        job_title:    'CEO',
        requests:     'Vegetarian meal',
      })
    }
  };
  const result = doPost(fakeEvent);
  Logger.log(result.getContent());
}



