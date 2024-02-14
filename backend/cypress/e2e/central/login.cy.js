import {url} from '../url';

describe('Test Central Homepage | Auth | Login page', () => {
    it('test login with empty fields', () => {
        cy.visit(url + '/login');
        // cy.contains('EN').click();
        cy.contains('تسجيل الدخول').get('button[type="submit"]').click();
        cy.contains('يرجى إدخال البريد الالكتروني');
        cy.get('input[type=email]').type('test@test.com');
        cy.contains('يرجى إدخال كلمة المرور');
        cy.get('input[type=password]').type('test123');
        cy.contains('تسجيل الدخول').get('button[type="submit"]').click();
        // @TODO: validate response
        // cy.wait('@authenticate').its('response.statusCode').should('eq', 403)
        // cy.wait('@authenticate').its('request.body').should('include', 'test@test.com')
        // cy.wait('@authenticate').its('response.body').should('include', 'test123')
    });
});
