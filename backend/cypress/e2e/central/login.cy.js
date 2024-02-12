import {url} from '../url';

describe('Test Central Homepage | Auth | Login page', () => {
    it('test login with invalid email', () => {
        cy.visit(url + '/login');
        // cy.contains('EN').click();
        cy.get('input[type="email"]').type('test');
        cy.get('button[type="submit"]').click();
    });
});
