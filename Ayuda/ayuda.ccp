<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Ayuda" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" isService="False">
	<Components>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="1" name="ayuda" connection="Datos" dataSource="ayuda" pageSizeLimit="100" wizardCaption="Lista de Ayuda " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Justified" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="ayuda">
			<Components>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="titulo" fieldSource="titulo" wizardCaption="Titulo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="contenido" fieldSource="contenido" wizardCaption="Contenido" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="8" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="ayudaNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="pagina" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="pagina" orderNumber="1"/>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="ayuda_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ayuda_id" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="10" tableName="ayuda" posWidth="127" posHeight="187" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="11" tableName="ayuda" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ayuda.php" comment="//" forShow="True" url="ayuda.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="ayuda_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="13"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
