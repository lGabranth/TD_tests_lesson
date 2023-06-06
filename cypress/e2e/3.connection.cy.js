describe('Connect user', () => {
  it('Connects the user and checks the homepage, then check a user details', () => {
    cy.visit('https://127.0.0.1:8000');
    cy.get('#emailField').type('test@gmail.com');
    cy.get('#passwordField').type('testtest');
    cy.get('#btnLogin').click();
    cy.url().should('not.include', 'login', { timeout: 10000 });
    cy.get('#dashboard').should('be.visible');
    cy.get('tbody').children().should('have.length.above', 1, { timeout: 10000 });
    cy.get('tbody > :nth-child(1) > :nth-child(3) > a.btn').click();
    cy.url().should('include', 'user', { timeout: 10000 });
    cy.get('[id^="MDBInput"]').eq(0).should('have.value', 'test@gmail.com');
  })
})