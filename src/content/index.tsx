import { Tile, TileData } from '../tile';
import styled from 'styled-components';

export type ContentItems = {
    readonly items: Partial<TileData>[];
};

const StyledContentContainer = styled.div``;

const Content = ({ items }: ContentItems) => (
    <StyledContentContainer>
        {items.map(
            (
                {
                    name = '',
                    notes = '',
                    url = '',
                    difficulty = '',
                    domains = [],
                },
                index
            ) => (
                <Tile
                    key={`item-${index}`}
                    name={name}
                    notes={notes}
                    url={url}
                    difficulty={difficulty}
                    domains={domains}
                />
            )
        )}
    </StyledContentContainer>
);

export default Content;
