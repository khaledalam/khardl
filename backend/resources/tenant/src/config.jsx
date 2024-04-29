// development
export const WEBSITE_URL =
  window.location.href.indexOf("khardl.com") > -1
    ? "https://khardl.com" // Live production
    : window.location.href.indexOf("khardl4test.xyz") > -1
      ? "https://khardl4test.xyz" // Live test
      : "http://khardl:8000"; // Local

export const API_ENDPOINT = url_tenant;

export const PREFIX_KEY = "khardl_tenant_";

export const HTTP_OK = 200;
export const HTTP_FORBIDDEN = 403;

export const HTTP_AUTHENTICATED = 200;
export const HTTP_NOT_AUTHENTICATED = 401;
export const HTTP_NOT_VERIFIED = 211;
// not approve restaurant owner trade documents
export const HTTP_BLOCKED = 207;

// live
// exportexport export const API_ENDPOINT = 'https://khardl.com/api';
// exportexport export const WEBSITE_URL = 'https://khardl.com';
