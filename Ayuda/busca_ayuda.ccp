<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Ayuda" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="ayudaSearch" wizardCaption="Buscar Ayuda " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="busca_ayuda.ccp" PathID="ayudaSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_keyword" wizardCaption="Palabra clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" visible="Yes" PathID="ayudaSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="17" fieldSourceType="DBColumn" dataType="Boolean" editable="True" name="todo" wizardTheme="Inline" wizardThemeType="File" checkedValue="true" uncheckedValue="false" visible="Yes" PathID="ayudaSearchtodo" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="ayudaSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="ayuda" connection="Datos" dataSource="ayuda" pageSizeLimit="100" wizardCaption="Lista de Ayuda " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Justified" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" PathID="ayuda">
			<Components>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ayuda_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="7"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="titulo" fieldSource="titulo" wizardCaption="Titulo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ayuda.ccp" visible="Yes" PathID="ayudatitulo">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="15" sourceType="DataField" name="ayuda_id" source="ayuda_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="11" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="contenido" fieldSource="contenido" wizardCaption="Contenido" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="12" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_titulo" fieldSource="titulo" wizardCaption="Titulo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ayuda.ccp" visible="Yes" PathID="ayudaAlt_titulo">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="16" sourceType="DataField" name="ayuda_id" source="ayuda_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="13" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="Alt_contenido" fieldSource="contenido" wizardCaption="Contenido" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="14" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="ayudaNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="18"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="titulo" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="contenido" parameterSource="s_keyword" dataType="Memo" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="busca_ayuda_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="busca_ayuda.php" comment="//" codePage="utf-8" forShow="True" url="busca_ayuda.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="19"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
