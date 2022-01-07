import styled from 'styled-components';

export type TileData = {
    readonly name: string;
    readonly url: string;
    readonly difficulty: string;
    readonly domains: string[] | string;
    readonly notes: string;
};

const findDifficultyColors = (
    difficulty: string
): { foreground: string; background: string } => {
    switch (difficulty) {
        case 'easy':
            return { background: '#84cc16', foreground: 'black' };
        case 'medium':
            return { background: '#facc15', foreground: 'black' };
        case 'hard':
            return { background: '#dc2626', foreground: 'white' };
        case 'impossible':
            return { background: '#404040', foreground: 'white' };
        default:
            return { background: 'rgb(250,250,250)', foreground: 'gray' };
    }
};

const StyledTileContainer = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin: 2em;
    border-radius: 1em;
    padding: 2em;
    overflow: hidden;
    box-shadow: 0 2px 24px rgb(0, 0, 0, 0.1);
`;

const StyledTileHeader = styled.div`
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
`;

const StyledTileTitle = styled.h2`
    font-weight: 300;
    margin-right: 1em;
    margin-top: 1em;
    margin-bottom: 0.8em;
`;

const StyledTileCopy = styled.span`
    font-weight: 400;
`;

const StyledTileDifficulty = styled.div<{ difficulty: string }>`
    margin-left: -2em;
    margin-top: -2em;
    margin-bottom: -2em;
    padding: 1em;

    ${(props) =>
        `background-color: ${
            findDifficultyColors(props.difficulty).background
        }`};
`;

export const StyledTileDifficultyTag = styled.span<{ difficulty: string }>`
    border-radius: 3px;
    padding: 0.5em;
    font-weight: bold;
    font-size: 0.8em;
    margin-top: 1em;
    margin-bottom: 0.8em;

    ${(props) => {
        const { background, foreground } = findDifficultyColors(
            props.difficulty
        );
        return `
                background-color: ${background};
                color: ${foreground};
            `;
    }}
`;

const StyledTileContent = styled.div`
    margin-top: -1em;
    padding-top: 0em;
    padding-bottom: 1em;
    padding-left: 2em;
    padding-right: 1em;
    flex-shrink: 1;
    flex-grow: 1;
    text-align: left;
    word-break: break-word;
`;

const StyledTileLink = styled.a`
    padding-top: 0.5em;
    display: block;
`;

export const Tile = ({ name, notes, url, difficulty }: TileData) => (
    <StyledTileContainer>
        <StyledTileDifficulty difficulty={difficulty} />
        <StyledTileContent>
            <StyledTileHeader>
                <StyledTileTitle>{name}</StyledTileTitle>
                <StyledTileDifficultyTag difficulty={difficulty}>
                    {difficulty.toLocaleUpperCase()}
                </StyledTileDifficultyTag>
            </StyledTileHeader>
            <StyledTileCopy>{notes}</StyledTileCopy>
            <StyledTileLink
                target="_blank"
                rel="noopener noreferrer"
                href={url}
            >
                {url}
            </StyledTileLink>
        </StyledTileContent>
    </StyledTileContainer>
);

export default Tile;
