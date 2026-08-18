(function(wp) {
    if (!wp || !wp.compose || !wp.element || !wp.blockEditor || !wp.components || !wp.data || !wp.hooks) {
        return;
    }

    const { createHigherOrderComponent } = wp.compose;
    const { Fragment, createElement } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, ToggleControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { addFilter } = wp.hooks;

    const withFeaturedImageToggle = createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            // Only apply to core/image block
            if (props.name !== 'core/image') {
                return createElement(BlockEdit, props);
            }

            // Get current featured image ID from the post
            const featuredImageId = useSelect((select) => {
                return select('core/editor').getEditedPostAttribute('featured_media');
            }, []);

            const { editPost } = useDispatch('core/editor');

            // Image ID of the current block
            const imageId = props.attributes.id;

            // Check if this image is the featured image
            const isFeatured = featuredImageId === imageId && imageId !== undefined && imageId !== 0;

            const toggleFeaturedImage = (newValue) => {
                if (newValue && imageId) {
                    editPost({ featured_media: imageId });
                } else {
                    // If unchecking, clear the featured image
                    editPost({ featured_media: 0 });
                }
            };

            return createElement(
                Fragment,
                {},
                createElement(BlockEdit, props),
                imageId ? createElement(
                    InspectorControls,
                    {},
                    createElement(
                        PanelBody,
                        { title: 'Featured Image', initialOpen: true },
                        createElement(ToggleControl, {
                            label: 'Set as Featured Image',
                            checked: isFeatured,
                            onChange: toggleFeaturedImage,
                        })
                    )
                ) : null
            );
        };
    }, 'withFeaturedImageToggle');

    addFilter(
        'editor.BlockEdit',
        'tcc/image-featured-toggle',
        withFeaturedImageToggle
    );

})(window.wp);
