import {createContext, useContext} from 'react';
export const API_URL = createContext(undefined);

export function useApiContext(){
    const api = useContext(API_URL);
    if(api === undefined)  return 'http://khardl:8000';
    return api;
}
