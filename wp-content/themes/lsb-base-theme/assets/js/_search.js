
(function($) {

	function addRelevantMetaAndContent(book) {
		var useRelevantContent = true;
		var relevant_meta = {};

		relevant_meta.creators = [];
		relevant_meta.topics = [];
		relevant_meta.partof = [];
		relevant_meta.audience = [];

		for ( var tax_key in book._highlightResult.taxonomies ) {
			var tax_terms = book._highlightResult.taxonomies[tax_key];
			for ( var term_index in tax_terms ) {
				var tax_term = tax_terms[term_index];
				if ( tax_term.matchLevel !== 'none' || tax_key === 'lsb_tax_author') {
					if( tax_key === 'lsb_tax_author' || tax_key === 'lsb_tax_illustrator' || tax_key === 'lsb_tax_translator') {
						relevant_meta.creators.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
					} else if( tax_key === 'lsb_tax_topic') {
						relevant_meta.topics.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
					} else if( tax_key === 'lsb_tax_series' || tax_key === 'lsb_tax_list' ) {
						relevant_meta.partof.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
					} else if( tax_key === 'lsb_tax_age' || tax_key === 'lsb_tax_audience' ) {
						relevant_meta.audience.push({value: tax_term.value, permalink: book.taxonomies_permalinks[tax_key][term_index]});
					}
				}

				if ( tax_term.matchLevel !== 'none' ) {
					useRelevantContent = false;
				}
			}
		}

		if( book._highlightResult.post_title.matchLevel !== 'none') {
			useRelevantContent = false;
		}

		if(useRelevantContent) {
			for ( var snippet_index in book._snippetResult ) {
				var snippet = book._snippetResult[snippet_index];
				if( snippet.matchLevel !== 'none') {
					book.relevant_content = snippet.value;
					break;
				}
			}
		}

		book.relevant_meta = relevant_meta;

	}

	var search = instantsearch({
		appId: algolia.application_id,
		apiKey: algolia.search_api_key,
		indexName: algolia.indices.posts_lsb_book.name,
		urlSync: {
			mapping: {
				'q': 's'
			},
			trackedParameters: ['query']
		},
		searchParameters: {
			facetingAfterDistinct: true,
			attributesToSnippet: [
				'lsb_review:20',
				'lsb_quote:20'
			],
		},
		searchFunction: function(helper) {
			console.log("Søk", search.helper.state.query)
			var savedPage = helper.state.page;
			var isSearchPage = $('body').hasClass('search');
			var mainSections = $('main');
			var searchResults = $('#search-page');
			var pageNav = $('.lsb-navbar-page');

			if ( search.helper.state.query === '' && !isSearchPage ) {
				mainSections.show();
				pageNav.show();
				searchResults.hide();
				return;
			}

			search.helper.setQueryParameter('distinct', true);
			search.helper.setQueryParameter('filters', '');
			search.helper.setPage(savedPage);
			helper.search();

			mainSections.hide();
			pageNav.hide();
			searchResults.show();
		}
	});

	// Search box widget
	$('#algolia-form input').each(function() {
		search.addWidget(
			instantsearch.widgets.searchBox({
				container: this,
				placeholder: $(this).attr('placeholder'),
				wrapInput: false,
				autofocus: false
			})
		);
	});

	// Hits widget
	search.addWidget(
		instantsearch.widgets.hits({
			container: '#algolia-hits',
			hitsPerPage: 30,
			transformData: {
				item: function(book) {
					addRelevantMetaAndContent(book);
					return book;
				},
			},
			templates: {
				empty: wp.template("instantsearch-empty"),
				item: wp.template('instantsearch-hit')
			},
			cssClasses: {
				root: ['loop'],
				item: ['lsb_book', 'summary']
			}
		})
	);

	// Pagination widget
	search.addWidget(
		instantsearch.widgets.pagination({
			container: '#algolia-pagination',
			cssClasses: {
				root: 'pagination'
			}
		})
	);

	// Start
	search.start();

	$searchInput = $('#algolia-form').each(function() {
		$(this).bind('submit', function(e) {
			e.preventDefault();
			$(this).find('input').blur();
			$(this).find('button').blur();
		});
	});

})(jQuery); // Fully reference jQuery after this point.