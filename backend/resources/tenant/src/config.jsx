// development

export const API_ENDPOINT = (window.location.href[window.location.href.length - 1] == '/')?window.location.href.slice(0,-1):window.location.href;
export const WEBSITE_URL = 'http://khardl:8000';


export const HTTP_OK            = 200;
export const HTTP_CREATED              = 201;
export const HTTP_UNAUTHORIZED         = 401;
export const HTTP_UNPROCESSABLE_ENTITY = 422;
export const HTTP_FORBIDDEN            = 403;
export const HTTP_NOT_FOUND            = 404;
export const HTTP_TOO_MANY_REQUESTS    = 429;

export const HTTP_AUTHENTICATED        = 200;
export const HTTP_NOT_AUTHENTICATED    = 401;
export const HTTP_VERIFIED             = 203;
export const HTTP_NOT_VERIFIED         = 211;
export const HTTP_ACCEPTED             = 205;
// not approve restaurant owner trade documents
export const HTTP_NOT_ACCEPTED         = 206;
export const HTTP_BLOCKED              = 207;

// live
// exportexport export const API_ENDPOINT = 'https://khardl.com/api';
// exportexport export const WEBSITE_URL = 'https://khardl.com';
