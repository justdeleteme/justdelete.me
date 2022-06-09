import { useState } from 'react';
import styled from 'styled-components';

import sites from './sites.json';

import Content from './content';
import { StyledTileDifficultyTag } from './tile';

const StyledAppHeader = styled.header`
    background-color: white;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    font-size: calc(10px + 2vmin);
    color: #404040;
    position: fixed;
    width: 100vw;
    top: 0;
    gap: 2em;
    border: 1px solid silver;
    padding: 0.25em;
`;

const StyledAppIntro = styled.div`
    margin-top: 7em;
    margin-left: 2em;
    margin-right: 2em;

    @media screen and (max-width: 640px) {
        margin-top: 5em;
    }
`;

const StyledAppName = styled.h1`
    font-weight: 300;
    font-size: 1em;
    flex-shrink: 0;
`;

const StyledSearchContainer = styled.div`
    display: flex;
    flex-direction: row;
    gap: 0.5em;
`;

const StyledSearchField = styled.input`
    border-radius: 2px;
    height: 32px;
    padding-right: 8px;
    padding-left: 8px;
    border-color: #737373;
    border-width: 1px;
    width: 132px;
`;

const StyledButton = styled.button`
    border-radius: 2px;
    border-color: white;
    border-width: 1px;
    height: 32px;
    padding-right: 8px;
    padding-left: 8px;
    font-size: 13px;
    font-weiht: 400;
    background-color: #0060df;
    color: white;
`;

const StyledDescriptionList = styled.dl`
    display: grid;
    grid-template-columns: min-content auto;
    row-gap: 1em;
`;

const StyledDescriptionTerm = styled.dt`
    align-self: center;
`;

const App = () => {
    const [filter, setFilter] = useState('');

    return (
        <div>
            <StyledAppHeader>
                <StyledAppName>Just Delete Me</StyledAppName>
                <StyledSearchContainer>
                    <StyledSearchField
                        type="text"
                        onChange={(e) => setFilter(e.target.value)}
                    />
                    <StyledButton>Search</StyledButton>
                </StyledSearchContainer>
            </StyledAppHeader>
            <StyledAppIntro>
                <p>
                    Use the filter and enter at least <em>three characters</em>{' '}
                    to check how hard it is to delete your account on a specific
                    service.{' '}
                </p>
                <p>
                    There are four levels how hard it is to delete your account:
                </p>
                <StyledDescriptionList>
                    <StyledDescriptionTerm>
                        <StyledTileDifficultyTag difficulty="easy">
                            easy
                        </StyledTileDifficultyTag>
                    </StyledDescriptionTerm>
                    <dd>Easy to delete your account.</dd>

                    <StyledDescriptionTerm>
                        <StyledTileDifficultyTag difficulty="medium">
                            medium
                        </StyledTileDifficultyTag>
                    </StyledDescriptionTerm>
                    <dd>Some extra steps are involved.</dd>

                    <StyledDescriptionTerm>
                        <StyledTileDifficultyTag difficulty="hard">
                            hard
                        </StyledTileDifficultyTag>
                    </StyledDescriptionTerm>
                    <dd>
                        Cannot be fully deleted without contacting customer
                        services.
                    </dd>

                    <StyledDescriptionTerm>
                        <StyledTileDifficultyTag difficulty="impossible">
                            impossible
                        </StyledTileDifficultyTag>
                    </StyledDescriptionTerm>
                    <dd>Cannot be deleted.</dd>
                </StyledDescriptionList>
            </StyledAppIntro>
            <div>
                <Content
                    items={sites
                        .filter(({ name = '' }) => {
                            const sanitizedFilter = (filter || '')
                                .trim()
                                .toLocaleLowerCase();

                            return (
                                sanitizedFilter.length <= 2 ||
                                name
                                    .toLocaleLowerCase()
                                    .indexOf(sanitizedFilter) >= 0
                            );
                        })
                        .map(({ name, url, domains, difficulty, notes }) => ({
                            name,
                            difficulty,
                            domains,
                            notes,
                            url,
                        }))}
                />
            </div>
        </div>
    );
};

export default App;
