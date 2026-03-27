/**
 * This configuration was generated using the CKEditor 5 Builder. You can modify it anytime using this link:
 * https://ckeditor.com/ckeditor-5/builder/?redirect=portal#installation/NoNgNARATAdAjHeFIBYDMaAMAOKBWbFATjwTShG0xD1MMxKOxBTjyKmJGQgFMA7ZJjDA4YYcLGSAupADGAIwoB2KNgjSgA==
 */

function WordPressMediaPlugin(editor) {
	editor.ui.componentFactory.add('wpMedia', locale => {
		const view = new window.CKEDITOR.ButtonView(locale);

		view.set({
			label: 'GxPhuHoa Media',
			icon: window.CKEDITOR.IconImage,
			tooltip: true
		});

		// Xử lý khi nhấn nút
		view.on('execute', () => {
			const frame = wp.media({
				title: 'Chọn hoặc tải ảnh lên',
				button: { text: 'Chèn vào bài viết' },
				multiple: false // Chỉ chọn 1 ảnh mỗi lần
			});

			frame.on('select', () => {
				const attachment = frame.state().get('selection').first().toJSON();

				// Chèn ảnh vào trình soạn thảo tại vị trí con trỏ
				editor.model.change(writer => {
					const imageElement = writer.createElement('imageBlock', {
						src: attachment.url,
						alt: attachment.alt || attachment.title
					});
					editor.model.insertContent(imageElement, editor.model.document.selection);
				});
			});

			frame.open();
		});

		return view;
	});
}

const {
	ClassicEditor,
	Alignment,
	Autosave,
	Essentials,
	FontBackgroundColor,
	FontColor,
	FontSize,
	Paragraph,
	Autoformat,
	TextTransformation,
	LinkImage,
	Link,
	ImageBlock,
	ImageToolbar,
	BlockQuote,
	Bold,
	CKBox,
	CloudServices,
	ImageUpload,
	ImageInsert,
	ImageInsertViaUrl,
	AutoImage,
	PictureEditing,
	CKBoxImageEdit,
	TableColumnResize,
	Table,
	TableToolbar,
	Emoji,
	Mention,
	Heading,
	ImageTextAlternative,
	ImageCaption,
	ImageResize,
	ImageStyle,
	Indent,
	IndentBlock,
	ImageInline,
	Italic,
	ListProperties,
	List,
	MediaEmbed,
	PasteFromOffice,
	TableCaption,
	TableCellProperties,
	TableProperties,
	TodoList,
	Underline
} = window.CKEDITOR;

const LICENSE_KEY =
	'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE4MDU4NDYzOTksImp0aSI6IjVjMGQ4ODBkLTFjZTMtNGMyYi1iNTJlLWFlNmM1ZjdlOTQwMSIsImxpY2Vuc2VkSG9zdHMiOlsiYWRtaW4uaG9wYW10aGFuaGNhLmNvbSIsImd4cGh1aG9hLm9yZyJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImZlYXR1cmVzIjpbIkRSVVAiLCJFMlAiLCJFMlciXSwidmMiOiI3NmQ4ZWNhMyJ9.XO8MnmfG2bSBJ8mKlzNj2QH_w0mTx4noL-mDaluXA9V2Vmbo6-ncEPWhS1P1X25ZDv9LxJ9z8NHZH_Uyb_aDwQ';

const CLOUD_SERVICES_TOKEN_URL =
	'https://79iv6hj461ya.cke-cs.com/token/dev/e401373f3b1a33d7ccb6478cdc7325d63e6fae59fb308dcb3a6b50c9779f?limit=10';

const editorConfig = {
	toolbar: {
		items: [
			'undo',
			'redo',
			'|',
			'heading',
			'fontSize',
			'|',
			'bold',
			'italic',
			'underline',
			'fontColor',
			'fontBackgroundColor',
			'|',
			'alignment:left',
			'alignment:center',
			'alignment:right',
			'alignment:justify',
			'|',
			'emoji',
			'link',
			'wpMedia',
			'ckbox',
			'mediaEmbed',
			'insertTable',
			'blockQuote',
			'|',
			'bulletedList',
			'numberedList',
			'todoList',
			'outdent',
			'indent'
		],
		shouldNotGroupWhenFull: false
	},
	plugins: [
		Alignment,
		Autoformat,
		AutoImage,
		Autosave,
		BlockQuote,
		Bold,
		CKBox,
		CKBoxImageEdit,
		CloudServices,
		Emoji,
		Essentials,
		FontBackgroundColor,
		FontColor,
		FontSize,
		Heading,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsert,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		LinkImage,
		List,
		ListProperties,
		MediaEmbed,
		Mention,
		Paragraph,
		PasteFromOffice,
		PictureEditing,
		Table,
		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		TextTransformation,
		TodoList,
		Underline
	],
	cloudServices: {
		tokenUrl: CLOUD_SERVICES_TOKEN_URL
	},
	alignment: {
		options: ['left', 'center', 'right', 'justify']
	},
	fontSize: {
		options: [12, 14, 16, 18, 20, 24, 28, 32]
	},
	image: {
		toolbar: [
			'imageTextAlternative',
			'toggleImageCaption',
			'|',
			'imageStyle:inline',
			'imageStyle:alignLeft',
			'imageStyle:alignCenter',
			'imageStyle:alignRight',
			'|',
			'resizeImage'
		],
		styles: ['inline', 'alignLeft', 'alignCenter', 'alignRight'],
		resizeUnit: '%'
	},
	heading: {
		options: [
			{
				model: 'paragraph',
				title: 'Paragraph',
				class: 'ck-heading_paragraph'
			},
			{
				model: 'heading1',
				view: 'h1',
				title: 'Heading 1',
				class: 'ck-heading_heading1'
			},
			{
				model: 'heading2',
				view: 'h2',
				title: 'Heading 2',
				class: 'ck-heading_heading2'
			},
			{
				model: 'heading3',
				view: 'h3',
				title: 'Heading 3',
				class: 'ck-heading_heading3'
			},
			{
				model: 'heading4',
				view: 'h4',
				title: 'Heading 4',
				class: 'ck-heading_heading4'
			},
			{
				model: 'heading5',
				view: 'h5',
				title: 'Heading 5',
				class: 'ck-heading_heading5'
			},
			{
				model: 'heading6',
				view: 'h6',
				title: 'Heading 6',
				class: 'ck-heading_heading6'
			}
		]
	},
	licenseKey: LICENSE_KEY,
	link: {
		addTargetToExternalLinks: true,
		defaultProtocol: 'https://',
		decorators: {
			toggleDownloadable: {
				mode: 'manual',
				label: 'Downloadable',
				attributes: {
					download: 'file'
				}
			}
		}
	},
	list: {
		properties: {
			styles: true,
			startIndex: true,
			reversed: true
		}
	},
	mention: {
		feeds: [
			{
				marker: '@',
				feed: [
					/* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
				]
			}
		]
	},
	placeholder: 'Type or paste your content here!',
	table: {
		contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
	},
	extraPlugins: [WordPressMediaPlugin],
	height: 300
};

configUpdateAlert(editorConfig);

ClassicEditor.create(document.querySelector('#content'), editorConfig);

/**
 * This function exists to remind you to update the config needed for premium features.
 * The function can be safely removed. Make sure to also remove call to this function when doing so.
 */
function configUpdateAlert(config) {
	if (configUpdateAlert.configUpdateAlertShown) {
		return;
	}

	const isModifiedByUser = (currentValue, forbiddenValue) => {
		if (currentValue === forbiddenValue) {
			return false;
		}

		if (currentValue === undefined) {
			return false;
		}

		return true;
	};

	const valuesToUpdate = [];

	configUpdateAlert.configUpdateAlertShown = true;

	if (!isModifiedByUser(config.licenseKey, '<YOUR_LICENSE_KEY>')) {
		valuesToUpdate.push('LICENSE_KEY');
	}

	if (!isModifiedByUser(config.cloudServices?.tokenUrl, '<YOUR_CLOUD_SERVICES_TOKEN_URL>')) {
		valuesToUpdate.push('CLOUD_SERVICES_TOKEN_URL');
	}

	if (valuesToUpdate.length) {
		window.alert(
			[
				'Please update the following values in your editor config',
				'to receive full access to Premium Features:',
				'',
				...valuesToUpdate.map(value => ` - ${value}`)
			].join('\n')
		);
	}
}
