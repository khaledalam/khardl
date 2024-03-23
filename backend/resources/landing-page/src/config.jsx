// development
export const API_ENDPOINT =
    window.location.href.indexOf('khardl.com') > -1
        ? 'https://khardl.com'  // Live production
        : (window.location.href.indexOf('khardl4test.xyz') > -1
            ? 'https://khardl4test.xyz' // Live test
            :'http://khardl:8000'); // Local


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
export const HTTP_REJECTED             = 208;

