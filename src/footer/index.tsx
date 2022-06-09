import styled from 'styled-components';

const StyledFooter = styled.div`
    color: white;
    background-color: #737373;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 2em;
`;

const StyledFooterColumn = styled.div`
    padding-top: 2em;
    padding-right: 1em;
    padding-left: 1em;
    padding-bottom: 2.75em;
`;

export const Footer = () => (
    <StyledFooter>
        <StyledFooterColumn>
            <h2>JustDeleteMe</h2>
            <p>
                Many companies use{' '}
                <a href="http://darkpatterns.org/" rel="noopener noreferrer">
                    dark pattern
                </a>{' '}
                techniques to make it difficult to find how to delete your
                account. This list aims to be a directory of urls to enable you
                to easily delete your account from web services.
            </p>
            <p>
                <a
                    href="https://github.com/arndissler/justdelete.me"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Fork me on GitHub
                </a>
            </p>
        </StyledFooterColumn>
        <StyledFooterColumn>Foo</StyledFooterColumn>
        <StyledFooterColumn></StyledFooterColumn>
    </StyledFooter>
);
