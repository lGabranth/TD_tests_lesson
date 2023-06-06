describe('Register user', () => {
  it('Registers the user and check the homepage, then logs out', () => {
    cy.visit('https://127.0.0.1:8000');
    cy.get('.btn-outline-warning').click();
    cy.wait(2000);
    cy.get('#usernameRegister').type('testCypress@yopmail.com');
    cy.get('#emailRegister').type('testCypress@yopmail.com');
    cy.get('#firstnameRegister').type('Jean');
    cy.get('#lastnameRegister').type('Test');
    cy.get('#passwordRegister').type('testtest');
    cy.get('#btnRegister').click();
    cy.url().should('not.include', 'login', { timeout: 10000 });
    cy.get('#dashboard').should('be.visible');
    cy.get('tbody').children().should('have.length.above', 1, { timeout: 10000 });
    cy.get('#btnLogout').click();
    cy.url().should('include', 'login', { timeout: 10000 });
    cy.visit('https://127.0.0.1:8000');
    cy.url().should('include', 'login', { timeout: 10000 });
  })
})